<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Cek autentikasi di guard master_users terlebih dahulu
        if (Auth::guard('master_users')->check()) {
            $user = Auth::guard('master_users')->user();
        } elseif (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
        } else {
            return redirect()->route('login');
        }
        
        // Check if user has any of the allowed roles
        if (!in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki permission untuk halaman ini.');
        }

        return $next($request);
    }
}
