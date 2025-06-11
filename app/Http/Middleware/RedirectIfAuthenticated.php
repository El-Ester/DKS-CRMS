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
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                if ($user->hasRole('Admin')) {
                    return redirect()->route('systemAdmin.dashboard');
                } elseif ($user->hasRole('Service Engineer')) {
                    return redirect()->route('serviceEngineer.dashboard');
                } elseif ($user->hasRole('DKS Staff')) {
                    return redirect()->route('DKSstaff.dashboard');
                }

                return redirect('/dashboard');
            }
        }

        return $next($request);
    }

}
