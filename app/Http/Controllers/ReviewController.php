<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $orderId)
    {
        $order = Order::with(['product', 'seller'])->findOrFail($orderId);
        $user = Auth::user();

        // Only buyer can review, only after completed, only if not reviewed yet
        if (!$user || $order->id_buyer != $user->id || $order->order_status != 'completed') {
            abort(403, 'Unauthorized');
        }
        if (Review::where('id_order', $order->id)->exists()) {
            return redirect()->back()->with('error', 'You have already reviewed this order.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'id_order' => $order->id,
            'id_buyer' => $user->id,
            'id_seller' => $order->id_seller,
            'id_product' => $order->id_product,
            'rating' => $validated['rating'],
            'review' => $validated['review'] ?? null,
        ]);

        // Update seller average rating and total reviews
        $seller = Seller::where('id_user', $order->id_seller)->first();
        if ($seller) {
            $avg = Review::where('id_seller', $order->id_seller)->avg('rating');
            $total = Review::where('id_seller', $order->id_seller)->count();
            $seller->rating = $avg;
            $seller->total_reviews = $total;
            $seller->save();
        }

        return redirect()->back()->with('success', 'Thank you for your review!');
    }
}
