<?php

namespace App\Http\Controllers;

use App\Models\CoinFlipGame;
use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CoinFlipController extends Controller
{
    public function show($id)
    {
        $coinFlip = CoinFlipGame::with(['negotiation.product', 'buyer', 'seller'])->findOrFail($id);
        $user = Auth::user();

        // Check authorization
        if ($coinFlip->id_buyer != $user->id && $coinFlip->id_seller != $user->id) {
            abort(403, 'Unauthorized access to this coin flip game');
        }

        return view('coinflip.show', compact('coinFlip'));
    }

    public function payDeposit($id)
    {
        $coinFlip = CoinFlipGame::findOrFail($id);
        $user = Auth::user();

        // Only buyer can pay deposit
        if ($coinFlip->id_buyer != $user->id) {
            abort(403, 'Only buyer can pay deposit');
        }

        // Check if already paid
        if ($coinFlip->buyer_dp_paid) {
            return redirect()->back()->with('info', 'Deposit already paid.');
        }

        // Check wallet balance
        $wallet = $user->wallet;
        if (!$wallet || !$wallet->hasBalance($coinFlip->dp_amount)) {
            return redirect()->route('wallet.topup')
                ->with('error', 'Insufficient balance. Please top-up your wallet first.');
        }

        DB::beginTransaction();
        try {
            // Deduct DP from buyer wallet (hold in escrow)
            $wallet->holdDeposit($coinFlip->dp_amount, 'Coin Flip DP - Negotiation #' . $coinFlip->id_negotiation);

            // Update coin flip status
            $coinFlip->buyer_dp_paid = true;
            $coinFlip->game_status = 'playing';
            $coinFlip->save();

            DB::commit();

            return redirect()->route('coinflip.show', $coinFlip->id)
                ->with('success', 'Deposit paid! Choose your side: Heads or Tails.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to pay deposit: ' . $e->getMessage());
        }
    }

    public function chooseSide(Request $request, $id)
    {
        $request->validate([
            'choice' => 'required|in:heads,tails',
        ]);

        $coinFlip = CoinFlipGame::findOrFail($id);
        $user = Auth::user();

        // Only buyer can choose
        if ($coinFlip->id_buyer != $user->id) {
            abort(403, 'Only buyer can choose side');
        }

        // Check if DP paid
        if (!$coinFlip->buyer_dp_paid) {
            return redirect()->back()->with('error', 'Please pay deposit first.');
        }

        // Check if already played
        if ($coinFlip->game_status !== 'playing') {
            return redirect()->back()->with('error', 'Game already finished.');
        }

        DB::beginTransaction();
        try {
            // Save buyer choice
            $coinFlip->buyer_call = $request->choice;
            $coinFlip->save();

            // Execute flip
            $coinFlip->flip();

            DB::commit();

            return redirect()->route('coinflip.result', $coinFlip->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to flip coin: ' . $e->getMessage());
        }
    }

    public function result($id)
    {
        $coinFlip = CoinFlipGame::with(['negotiation.product', 'buyer', 'seller'])->findOrFail($id);
        $user = Auth::user();

        // Check authorization
        if ($coinFlip->id_buyer != $user->id && $coinFlip->id_seller != $user->id) {
            abort(403);
        }

        return view('coinflip.result', compact('coinFlip'));
    }

    public function payRemaining(Request $request, $id)
    {
        $coinFlip = CoinFlipGame::findOrFail($id);
        $user = Auth::user();

        // Only buyer can pay
        if ($coinFlip->id_buyer != $user->id) {
            abort(403);
        }

        // Check if game finished
        if ($coinFlip->game_status !== 'finished') {
            return redirect()->back()->with('error', 'Game not finished yet.');
        }

        // Check if already paid
        if ($coinFlip->buyer_paid) {
            return redirect()->back()->with('info', 'Payment already completed.');
        }

        // Validate buyer notes
        $request->validate([
            'buyer_notes' => 'nullable|string|max:500',
        ]);

        $remainingPayment = $coinFlip->getRemainingPayment();
        $wallet = $user->wallet;

        // Check wallet balance
        if (!$wallet || !$wallet->hasBalance($remainingPayment)) {
            return redirect()->route('wallet.topup')
                ->with('error', 'Insufficient balance. Please top-up your wallet first.');
        }

        DB::beginTransaction();
        try {
            // Calculate platform fee first
            $platformFee = $coinFlip->final_price * 0.03; // 3% platform fee

            // Deduct remaining payment from buyer
            $wallet->deductBalance($remainingPayment, 'purchase', 'Coin Flip Final Payment - Negotiation #' . $coinFlip->id_negotiation);

            // (Saldo seller BELUM masuk di sini)

            // Update coin flip status
            $coinFlip->buyer_paid = true;
            $coinFlip->save();

            // Keep negotiation status as 'coinflip' (don't change to 'completed' - not in enum)
            // Payment done, order created, but status stays 'coinflip'
            $negotiation = $coinFlip->negotiation;

            // Update ALL offers to accepted (deal is final)
            $negotiation->offers()->whereIn('status', ['pending', 'countered'])->update(['status' => 'accepted']);

            // Create order
            $order = Order::create([
                'id_product' => $negotiation->id_product,
                'id_buyer' => $coinFlip->id_buyer,
                'id_seller' => $coinFlip->id_seller,
                'id_negotiation' => $negotiation->id,
                'quantity' => 1,
                'original_price' => $negotiation->product->getCurrentPrice(), // Original product price
                'final_price' => $coinFlip->final_price,
                'platform_fee' => $platformFee,
                'payment_method' => 'wallet',
                'payment_status' => 'paid',
                'order_status' => 'pending',
                'buyer_notes' => $request->input('buyer_notes'),
            ]);

            // Update product stock
            $product = $negotiation->product;
            $product->stock -= 1;
            if ($product->stock <= 0) {
                $product->status = 'sold';
            }
            $product->save();

            DB::commit();

            return redirect()->route('negotiation.show', $coinFlip->id_negotiation)
                ->with('success', 'Payment completed! Order created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to process payment: ' . $e->getMessage());
        }
    }

    public function handlePenalty($id)
    {
        $coinFlip = CoinFlipGame::findOrFail($id);

        // Check if payment is overdue and not yet paid
        if (!$coinFlip->isPaymentOverdue() || $coinFlip->buyer_paid) {
            return redirect()->back()->with('error', 'Penalty cannot be applied.');
        }

        // Check if penalty already distributed
        if ($coinFlip->penalty_distributed) {
            return redirect()->back()->with('info', 'Penalty already distributed.');
        }

        DB::beginTransaction();
        try {
            // Split DP: 60% to seller, 40% to marketplace
            $sellerShare = $coinFlip->dp_amount * 0.6;
            $marketplaceShare = $coinFlip->dp_amount * 0.4;

            // Give seller 60%
            $sellerWallet = Wallet::firstOrCreate(
                ['id_user' => $coinFlip->id_seller],
                ['balance' => 0]
            );
            $sellerWallet->receivePenalty($sellerShare, 'Penalty from buyer (60%) - Coin Flip #' . $coinFlip->id);

            // Marketplace gets 40% (add to admin wallet or skip for now)
            // TODO: Add to admin/marketplace wallet

            // Mark penalty as distributed
            $coinFlip->penalty_distributed = true;
            $coinFlip->save();

            DB::commit();

            return redirect()->route('negotiation.show', $coinFlip->id_negotiation)
                ->with('info', 'Buyer failed to pay. Deposit penalty distributed.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to distribute penalty: ' . $e->getMessage());
        }
    }
}
