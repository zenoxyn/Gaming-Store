<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class WalletController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function index()
    {
        $user = Auth::user();

        // Get or create wallet
        $wallet = $user->wallet ?? Wallet::create([
            'id_user' => $user->id,
            'balance' => 0,
        ]);

        // Get transaction history with pagination
        $transactions = $wallet->transactions()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('wallet.index', compact('wallet', 'transactions'));
    }

    public function topup()
    {
        $user = Auth::user();
        $wallet = $user->wallet ?? Wallet::create([
            'id_user' => $user->id,
            'balance' => 0,
        ]);

        return view('wallet.topup', compact('wallet'));
    }

    public function processTopup(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:10000|max:10000000',
        ]);

        $user = Auth::user();
        $wallet = $user->wallet ?? Wallet::create([
            'id_user' => $user->id,
            'balance' => 0,
        ]);

        $amount = $request->amount;

        // Create pending transaction record
        $transaction = WalletTransaction::create([
            'id_wallet' => $wallet->id,
            'type' => 'topup',
            'amount' => $amount,
            'balance_before' => $wallet->balance,
            'balance_after' => $wallet->balance, // Will be updated after payment
            'description' => 'Top-up via Midtrans',
        ]);

        // Midtrans transaction details
        $params = [
            'transaction_details' => [
                'order_id' => 'TOPUP-' . $transaction->id . '-' . time(),
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => $user->username,
                'email' => $user->email,
                'phone' => $user->phone ?? '08123456789',
            ],
            'item_details' => [
                [
                    'id' => 'TOPUP',
                    'price' => $amount,
                    'quantity' => 1,
                    'name' => 'Wallet Top-up',
                ],
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'snap_token' => $snapToken,
                'transaction_id' => $transaction->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create payment: ' . $e->getMessage()
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                // Extract transaction ID from order_id (format: TOPUP-{id}-{timestamp})
                $orderId = $request->order_id;
                $parts = explode('-', $orderId);
                $transactionId = $parts[1] ?? null;

                if ($transactionId) {
                    $transaction = WalletTransaction::find($transactionId);

                    if ($transaction && $transaction->balance_before == $transaction->balance_after) {
                        // Update wallet balance
                        $wallet = $transaction->wallet;
                        $wallet->balance += $transaction->amount;
                        $wallet->save();

                        // Update transaction
                        $transaction->balance_after = $wallet->balance;
                        $transaction->description = 'Top-up successful via Midtrans - ' . $request->order_id;
                        $transaction->save();
                    }
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function success(Request $request)
    {
        // For local testing: update pending transactions that haven't been processed
        $user = Auth::user();
        $wallet = $user->wallet;

        if ($wallet) {
            // Find pending topup transactions (where balance_before == balance_after)
            $pendingTransactions = WalletTransaction::where('id_wallet', $wallet->id)
                ->where('type', 'topup')
                ->whereColumn('balance_before', 'balance_after')
                ->orderBy('created_at', 'desc')
                ->limit(1) // Only process the latest one
                ->get();

            foreach ($pendingTransactions as $transaction) {
                // Update wallet balance
                $wallet->balance += $transaction->amount;
                $wallet->save();

                // Update transaction record
                $transaction->balance_after = $wallet->balance;
                $transaction->description = 'Top-up successful via Midtrans (Manual confirmation)';
                $transaction->save();
            }
        }

        return redirect()->route('wallet.index')->with('success', 'Top-up successful! Your balance has been updated.');
    }

    public function pending(Request $request)
    {
        return redirect()->route('wallet.index')->with('info', 'Payment is being processed. Please wait for confirmation.');
    }

    public function error(Request $request)
    {
        return redirect()->route('wallet.topup')->with('error', 'Payment failed. Please try again.');
    }
}
