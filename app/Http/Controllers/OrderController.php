<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $status = $request->get('status', 'all'); // all, pending, completed, canceled

        // Automatically determine tab based on user role
        $isSeller = $user->seller && $user->seller->verification_status === 'verified';
        $tab = $isSeller ? 'seller' : 'buyer';

        if ($tab === 'buyer') {
            // Orders where user is buyer
            $query = Order::where('id_buyer', $user->id)
                ->with(['product', 'seller'])
                ->latest();
        } else {
            // Orders where user is seller
            $query = Order::where('id_seller', $user->id)
                ->with(['product', 'buyer'])
                ->latest();
        }

        // Filter by status
        if ($status !== 'all') {
            $query->where('order_status', $status);
        }

        $orders = $query->paginate(10);

        return view('orders.index', compact('orders', 'tab', 'status'));
    }

    public function show($id)
    {
        $order = Order::with(['product', 'buyer', 'seller'])->findOrFail($id);
        $user = Auth::user();

        // Check authorization
        if ($order->id_buyer != $user->id && $order->id_seller != $user->id) {
            abort(403, 'Unauthorized access to this order');
        }

        return view('orders.show', compact('order'));
    }

    public function checkout($productId)
    {
        $product = Product::with(['seller', 'category'])->findOrFail($productId);
        $user = Auth::user();

        // Check if user is the seller
        if ($product->id_seller == $user->id) {
            return redirect()->back()->with('error', 'You cannot buy your own product!');
        }

        // Check if product is available
        if ($product->status !== 'available' || $product->stock < 1) {
            return redirect()->back()->with('error', 'This product is not available.');
        }

        return view('checkout.index', compact('product'));
    }

    public function buyNow(Request $request, $productId)
    {
        $product = Product::with('seller')->findOrFail($productId);
        $user = Auth::user();

        // Check if user is the seller
        if ($product->seller->id_user == $user->id) {
            return redirect()->back()->with('error', 'You cannot buy your own product!');
        }

        // Check if product is available
        if ($product->status !== 'available' || $product->stock < 1) {
            return redirect()->back()->with('error', 'This product is not available.');
        }

        $price = $product->getCurrentPrice();
        $platformFee = $price * 0.03; // 3% platform fee

        // Validate buyer notes
        $request->validate([
            'buyer_notes' => 'nullable|string|max:500',
        ]);

        // Check buyer wallet balance
        $buyerWallet = Wallet::where('id_user', $user->id)->first();
        if (!$buyerWallet || !$buyerWallet->hasBalance($price)) {
            return redirect()->route('wallet.topup')
                ->with('error', 'Insufficient wallet balance. Please top-up first.');
        }

        DB::beginTransaction();
        try {
            // Deduct from buyer wallet
            $buyerWallet->deductBalance($price, 'purchase', 'Direct purchase - Product #' . $product->id);

            // Add to seller wallet (minus platform fee)
            $sellerWallet = Wallet::firstOrCreate(
                ['id_user' => $product->seller->id_user],
                ['balance' => 0]
            );
            $sellerAmount = $price - $platformFee;
            $sellerWallet->addBalance($sellerAmount, 'sale', 'Product sale - Direct purchase #' . $product->id);

            // Create order
            $order = Order::create([
                'id_product' => $product->id,
                'id_buyer' => $user->id,
                'id_seller' => $product->seller->id_user,
                'quantity' => 1,
                'original_price' => $price,
                'final_price' => $price,
                'platform_fee' => $platformFee,
                'payment_method' => 'wallet',
                'payment_status' => 'paid',
                'order_status' => 'pending',
                'buyer_notes' => $request->input('buyer_notes'),
            ]);

            // Update product stock
            $product->stock -= 1;
            if ($product->stock <= 0) {
                $product->status = 'sold';
            }
            $product->save();

            DB::commit();

            return redirect()->route('order.show', $order->id)
                ->with('success', 'Payment successful! Your order has been created.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to process payment: ' . $e->getMessage());
        }
    }

    public function uploadDelivery(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        // Only seller can upload delivery
        if ($order->id_seller != $user->id) {
            abort(403, 'Unauthorized action');
        }

        // Only allow if payment is completed and order is pending
        if ($order->payment_status !== 'paid' || $order->order_status !== 'pending') {
            return redirect()->back()->with('error', 'Cannot upload delivery for this order status.');
        }

        $request->validate([
            'delivery_proof' => 'required|string|max:1000',
            'delivery_notes' => 'nullable|string|max:500',
        ]);

        $order->update([
            'delivery_proof' => $request->delivery_proof,
            'delivery_info' => $request->delivery_notes,
            'delivery_uploaded_at' => now(),
            'order_status' => 'processing',
        ]);

        return redirect()->back()->with('success', 'Delivery information uploaded successfully!');
    }

    public function confirmDelivery($id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        // Only buyer can confirm delivery
        if ($order->id_buyer != $user->id) {
            abort(403, 'Unauthorized action');
        }

        // Only allow if order is in processing status
        if ($order->order_status !== 'processing') {
            return redirect()->back()->with('error', 'Cannot confirm delivery for this order status.');
        }

        $order->update([
            'order_status' => 'completed',
            'completed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Order completed! Thank you for your confirmation.');
    }
}
