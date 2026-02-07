<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // IZINKAN HALAMAN LOGIN ADMIN (GET & POST)
        if ($request->routeIs('admin.login')) {
            return $next($request);
        }

        // CEK LOGIN + ROLE ADMIN
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // JIKA BUKAN ADMIN
        return redirect()->route('admin.login')
            ->with('error', 'Akses khusus admin!');
    }
}
