<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
