<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApplicationController extends Controller
{
    /**
     * Show seller application form
     */
    public function showForm()
    {
        $user = Auth::user();

        // Check if user already has a seller account
        if ($user->seller) {
            return redirect()->route('buyer.dashboard')
                ->with('error', 'You already have a seller account!');
        }

        return view('seller.apply');
    }

    /**
     * Submit seller application
     */
    public function submit(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        // Double check if user already has a seller account
        if ($user->seller) {
            return redirect()->route('buyer.dashboard')
                ->with('error', 'You already have a seller account!');
        }

        $validated = $request->validate([
            'legal_name' => 'required|string|max:100',
            'id_card_number' => 'required|string|max:20|unique:sellers,id_card_number',
            'id_card_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'bank_name' => 'required|string|max:50',
            'bank_account_number' => 'required|string|max:30',
            'bank_account_name' => 'required|string|max:100',
        ]);

        // Handle ID card photo upload
        $idCardPath = $request->file('id_card_photo')->store('id_cards', 'public');

        // Create seller record
        Seller::create([
            'id_user' => $user->id,
            'legal_name' => $validated['legal_name'],
            'id_card_number' => $validated['id_card_number'],
            'id_card_photo' => $idCardPath,
            'bank_name' => $validated['bank_name'],
            'bank_account_number' => $validated['bank_account_number'],
            'bank_account_name' => $validated['bank_account_name'],
            'verification_status' => 'pending',
        ]);

        // Don't change role yet - will be changed to 'seller' after admin verification

        return redirect()->route('buyer.dashboard')
            ->with('success', 'Your seller application has been submitted! Please wait for admin verification.');
    }
}
