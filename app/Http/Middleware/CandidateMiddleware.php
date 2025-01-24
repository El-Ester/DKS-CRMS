<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
{
    if (!Auth::guard('candidate')->check()) {
        return redirect()->route('candidate.login');
    }

    return $next($request);
}

}
