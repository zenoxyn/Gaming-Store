<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        // Debug log
        Log::info('RoleMiddleware Check', [
            'user_id' => $user->id,
            'user_role' => $user->role_user,
            'required_roles' => $roles,
        ]);


        // Check if user has required role
        // Sellers can also access buyer routes (sellers can buy too)
        if ($user->role_user === 'seller' && in_array('buyer', $roles)) {
            return $next($request);
        }

        if (!in_array($user->role_user, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini. Role: ' . $user->role_user . ', Required: ' . implode(',', $roles));
        }

        return $next($request);
    }
}
