<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the authenticated user has the required role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // If not, redirect to login or another page
        return redirect()->route('login')->with('error', 'Unauthorized access');
    }
}
