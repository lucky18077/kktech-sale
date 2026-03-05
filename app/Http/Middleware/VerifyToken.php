<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class VerifyToken
{
    /**
     * Handle an incoming request to verify token like legacy system.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated via session/guard
        if (auth()->check()) {
            $user = auth()->user();
            
            // Verify token in database matches session
            if ($user->token && session('token') === $user->token) {
                return $next($request);
            }
        }

        // If token invalid, logout and redirect to login
        auth()->logout();
        $request->session()->invalidate();
        
        return redirect('/')->with('error', 'Session expired. Please login again.');
    }
}
