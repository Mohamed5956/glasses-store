<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            return $next($request);
        }

// Check if the current route is the login route
        if (Route::currentRouteName() == 'login') {
            return $next($request);
        }

// Check if the user is authenticated
        if (Auth::check()) {
            return to_route('home.index');
        }

        return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
    }
}
