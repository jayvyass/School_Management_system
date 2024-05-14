<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && $request->user()->tokens->isNotEmpty()) {
            
            if (Auth::user()->roles === 'admin') {
                return $next($request);
            }
            elseif (Auth::user()->roles === 'teacher') {
                return redirect()->route('results')->with('custom_error', 'Teachers have limited access to attendance & Results.');
            }
            else {
                return redirect()->route('signin')->with('custom_error', 'Unauthorized Access, Please Sign-in.');
            }
        
        } else {
            // User is not authenticated or has no token, redirect to sign-in page
            return redirect()->route('signin')->with('custom2_error', 'Please sign in to access this page.');
        }
    }
}




      