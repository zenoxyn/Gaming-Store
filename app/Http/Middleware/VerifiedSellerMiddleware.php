<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifiedSellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();


        // Check if user has seller account
        if (!$user->seller) {
            return redirect()->route('buyer.dashboard')
                ->with('error', 'You need to apply as a seller first.');
        }

        // Check if seller is verified
        if ($user->seller->verification_status !== 'verified') {
            return redirect()->route('buyer.dashboard')
                ->with('error', 'Your seller account is still pending verification. Please wait for admin approval.');
        }

        return $next($request);
    }
}
