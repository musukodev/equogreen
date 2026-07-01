<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = strtolower(Auth::user()->role);
        $allowedRoles = array_map('strtolower', $roles);

        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        // Jika tidak berhak, redirect ke dashboard masing-masing
        if ($userRole === 'vendor') {
            return redirect()->route('vendor-dashboard')->with('error', 'Akses ditolak.');
        }

        return redirect()->route('procurement-dashboard')->with('error', 'Akses ditolak.');
    }
}
