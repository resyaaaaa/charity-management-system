<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in
        if (Auth::check() && Auth::user()->role === 'staff') {
            return $next($request); // Allow access
        }

        // Otherwise, redirect to login or home with error
        return redirect()->route('login')->withErrors(['access' => 'You do not have permission to access this page.']);
    }
}
