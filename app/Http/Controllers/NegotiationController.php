<?php

namespace App\Http\Controllers;

use App\Models\Negotiation;
use App\Models\NegotiationOffer;
use App\Models\Product;
use App\Models\CoinFlipGame;
use App\Models\Wallet;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NegotiationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get negotiations where user is buyer or seller
        $negotiations = Negotiation::where(function($query) use ($user) {
                $query->where('id_buyer', $user->id)
                      ->orWhere('id_seller', $user->id);
            })
            ->with(['product', 'buyer', 'seller', 'offers' => function($q) {
                $q->latest();
            }])
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('negotiation.index', compact('negotiations'));
    }

    public function show($id)
    {
        $negotiation = Negotiation::with(['product', 'buyer', 'seller', 'offers.sender', 'coinFlipGame'])
            ->findOrFail($id);

        $user = Auth::user();

        // Check authorization
        if ($negotiation->id_buyer != $user->id && $negotiation->id_seller != $user->id) {
            abort(403, 'Unauthorized access to this negotiation');
        }

        // Check if expired
        if ($negotiation->isExpired() && $negotiation->status === 'ongoing') {
            $negotiation->status = 'expired';
            $negotiation->save();
        }

        return view('negotiation.show', compact('negotiation'));
    }

    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        $user = Auth::user();

        // Check if user is the seller
        if ($product->id_seller == $user->id) {
            return redirect()->back()->with('error', 'You cannot negotiate your own product!');
        }

        // Check if product is available
        if ($product->status !== 'available') {
            return redirect()->back()->with('error', 'This product is not available for negotiation.');
        }

        // Check if active negotiation already exists (ongoing, accepted, or unpaid coinflip)
        $existingNego = Negotiation::where('id_product', $productId)
            ->where('id_buyer', $user->id)
            ->whereIn('status', ['ongoing', 'accepted'])
            ->first();

        // Also check for unpaid coin flip
        if (!$existingNego) {
            $existingNego = Negotiation::where('id_product', $productId)
                ->where('id_buyer', $user->id)
                ->where('status', 'coinflip')
                ->whereHas('coinFlipGame', function($q) {
                    $q->where('buyer_paid', false);
                })
                ->first();
        }

        if ($existingNego) {
            return redirect()->route('negotiation.show', $existingNego->id)
                ->with('info', 'You already have an ongoing negotiation for this product.');
        }

        return view('negotiation.create', compact('product'));
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'offered_price' => 'required|integer|min:1000',
            'notes' => 'nullable|string|max:500',
        ]);

        $product = Product::findOrFail($productId);
        $user = Auth::user();

        DB::beginTransaction();
        try {
            // Create negotiation
            $negotiation = Negotiation::create([
                'id_product' => $productId,
                'id_buyer' => $user->id,
                'id_seller' => $product->seller->id_user,
                'latest_buyer_offer' => $request->offered_price,
                'latest_seller_offer' => $product->price,
                'status' => 'ongoing',
                'expires_at' => now()->addDay(),
            ]);

            // Create first offer from buyer
            NegotiationOffer::create([
                'id_negotiation' => $negotiation->id,
                'id_sender' => $user->id,
                'offered_price' => $request->offered_price,
                'notes' => $request->notes,
                'status' => 'pending',
            ]);

            DB::commit();

            return redirect()->route('negotiation.show', $negotiation->id)
                ->with('success', 'Negotiation started! Waiting for seller response.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to start negotiation: ' . $e->getMessage());
        }
    }

    public function counter(Request $request, $id)
    {
        $request->validate([
            'offered_price' => 'required|integer|min:1000',
            'notes' => 'nullable|string|max:500',
        ]);

        $negotiation = Negotiation::findOrFail($id);
        $user = Auth::user();

        // Check authorization
        if ($negotiation->id_buyer != $user->id && $negotiation->id_seller != $user->id) {
            abort(403);
        }

        // Check if negotiation is still ongoing
        if ($negotiation->status !== 'ongoing') {
            return redirect()->back()->with('error', 'This negotiation is no longer active.');
        }

        DB::beginTransaction();
        try {
            // Mark previous offers as countered
            $negotiation->offers()->where('status', 'pending')->update(['status' => 'countered']);

            // Create counter offer
            NegotiationOffer::create([
                'id_negotiation' => $negotiation->id,
                'id_sender' => $user->id,
                'offered_price' => $request->offered_price,
                'notes' => $request->notes,
                'status' => 'pending',
            ]);

            // Update latest offers in negotiation
            if ($user->id == $negotiation->id_buyer) {
                $negotiation->latest_buyer_offer = $request->offered_price;
            } else {
                $negotiation->latest_seller_offer = $request->offered_price;
            }

            // Update expiry
            $negotiation->updateExpiry();

            DB::commit();

            return redirect()->route('negotiation.show', $negotiation->id)
                ->with('success', 'Counter offer sent!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to send counter offer: ' . $e->getMessage());
        }
    }

    public function accept($id)
    {
        $negotiation = Negotiation::findOrFail($id);
        $user = Auth::user();

        // Check authorization
        if ($negotiation->id_buyer != $user->id && $negotiation->id_seller != $user->id) {
            abort(403);
        }

        // Update negotiation status
        $negotiation->status = 'accepted';
        $negotiation->offers()->where('status', 'pending')->update(['status' => 'accepted']);
        $negotiation->save();

        return redirect()->route('negotiation.show', $negotiation->id)
            ->with('success', 'Offer accepted! Please proceed to payment.');
    }

    public function payAcceptedOffer($id)
    {
        $negotiation = Negotiation::findOrFail($id);
        $user = Auth::user();

        // Only buyer can pay
        if ($negotiation->id_buyer != $user->id) {
            abort(403, 'Only buyer can make payment');
        }

        // Check if negotiation is accepted
        if ($negotiation->status != 'accepted') {
            return redirect()->back()->with('error', 'Negotiation must be accepted first.');
        }

        // Determine final price
        $finalPrice = $negotiation->latest_seller_offer ?? $negotiation->latest_buyer_offer;

        // Check buyer wallet balance
        $buyerWallet = Wallet::where('id_user', $negotiation->id_buyer)->first();
        if (!$buyerWallet || !$buyerWallet->hasBalance($finalPrice)) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please top-up first.');
        }

        DB::beginTransaction();
        try {
            // Deduct from buyer wallet
            $buyerWallet->deductBalance($finalPrice, 'purchase', 'Product purchase from negotiation #' . $negotiation->id);

            // Add to seller wallet
            $sellerWallet = Wallet::firstOrCreate(
                ['id_user' => $negotiation->id_seller],
                ['balance' => 0]
            );
            $platformFee = $finalPrice * 0.03; // 3% platform fee
            $sellerAmount = $finalPrice - $platformFee;
            $sellerWallet->addBalance($sellerAmount, 'sale', 'Product sale from negotiation #' . $negotiation->id);

            // Create order
            $order = Order::create([
                'id_product' => $negotiation->id_product,
                'id_buyer' => $negotiation->id_buyer,
                'id_seller' => $negotiation->id_seller,
                'quantity' => 1,
                'original_price' => $negotiation->product->getCurrentPrice(), // Original product price
                'final_price' => $finalPrice,
                'platform_fee' => $platformFee,
                'payment_method' => 'wallet',
                'payment_status' => 'paid',
                'order_status' => 'pending',
            ]);

            // Update product stock
            $product = $negotiation->product;
            $product->stock -= 1;
            if ($product->stock <= 0) {
                $product->status = 'sold';
            }
            $product->save();

            DB::commit();

            return redirect()->route('negotiation.show', $negotiation->id)
                ->with('success', 'Payment completed! Order created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to process: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        $negotiation = Negotiation::findOrFail($id);
        $user = Auth::user();

        // Check authorization
        if ($negotiation->id_buyer != $user->id && $negotiation->id_seller != $user->id) {
            abort(403);
        }

        $negotiation->status = 'rejected';
        $negotiation->offers()->where('status', 'pending')->update(['status' => 'rejected']);
        $negotiation->save();

        return redirect()->route('negotiation.index')
            ->with('info', 'Negotiation rejected.');
    }

    public function initiateCoinFlip($id)
    {
        $negotiation = Negotiation::findOrFail($id);
        $user = Auth::user();

        // Check authorization (both parties must agree, but either can initiate)
        if ($negotiation->id_buyer != $user->id && $negotiation->id_seller != $user->id) {
            abort(403);
        }

        // Check if negotiation is ongoing
        if ($negotiation->status !== 'ongoing') {
            return redirect()->back()->with('error', 'Negotiation must be ongoing to start coin flip.');
        }

        // Check if both parties have made offers
        if (!$negotiation->latest_buyer_offer || !$negotiation->latest_seller_offer) {
            return redirect()->back()->with('error', 'Both parties must make an offer first.');
        }

        // Check if someone already proposed
        if ($negotiation->coinflip_proposed_by) {
            // If the other party clicks, create the game
            if ($negotiation->coinflip_proposed_by != $user->id) {
                DB::beginTransaction();
                try {
                    // Calculate DP amount
                    $dpAmount = $negotiation->calculateDpAmount();

            // Create coin flip game
            $coinFlip = CoinFlipGame::create([
                'id_negotiation' => $negotiation->id,
                'id_buyer' => $negotiation->id_buyer,
                'id_seller' => $negotiation->id_seller,
                'dp_amount' => $dpAmount,
                'buyer_dp_paid' => false,
                'result' => 'pending',
                'game_status' => 'waiting_dp',
            ]);

            // Update negotiation status
            $negotiation->status = 'coinflip';
            $negotiation->save();

                    DB::commit();

                    return redirect()->route('coinflip.show', $coinFlip->id)
                        ->with('success', 'Coin Flip Game started! Buyer must pay deposit to continue.');

                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Failed to start coin flip: ' . $e->getMessage());
                }
            } else {
                return redirect()->back()->with('info', 'You already proposed coin flip. Waiting for other party to agree.');
            }
        } else {
            // First proposal - save proposer
            $negotiation->coinflip_proposed_by = $user->id;
            $negotiation->save();

            return redirect()->back()->with('success', 'Coin flip proposed! Waiting for other party to agree.');
        }
    }
}
