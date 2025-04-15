<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Jika pengguna sudah login, arahkan mereka ke dashboard sesuai role
        if ($user) {
            if ($user->role === 'admin') {
                return redirect()->route('admin.admin');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard');
            }
        }

        // Jika pengguna belum login, lanjutkan ke halaman yang diminta
        return $next($request);
    }
}
