<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'admin') {
            // If user is authenticated but not admin, redirect to their appropriate dashboard
            if (Auth::user()->role === 'user') {
                return redirect()->route('user.dashboard');
            }
            return redirect()->route('login');
        }

        return $next($request);
    }
}
