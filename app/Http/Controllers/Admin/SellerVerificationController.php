<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerVerificationController extends Controller
{
    /**
     * Display pending seller verifications
     */
    public function index()
    {
        $pendingSellers = Seller::with('user')
            ->where('verification_status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.sellers.verification', compact('pendingSellers'));
    }

    /**
     * Approve seller verification
     */
    public function approve($id)
    {
        $seller = Seller::findOrFail($id);

        $seller->update([
            'verification_status' => 'verified',
            'verified_at' => now(),
        ]);

        // Change user role to seller
        $seller->user->update(['role_user' => 'seller']);

        return redirect()->route('admin.sellers.verification')
            ->with('success', "Seller {$seller->user->username} has been verified successfully!");
    }

    /**
     * Reject seller verification
     */
    public function reject(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);

        $seller->update([
            'verification_status' => 'rejected',
            'verified_at' => null,
        ]);

        // User remains as buyer

        return redirect()->route('admin.sellers.verification')
            ->with('success', "Seller {$seller->user->username} has been rejected.");
    }
}
