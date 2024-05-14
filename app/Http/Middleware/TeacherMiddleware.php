<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && $request->user()->tokens->isNotEmpty()) {
            $role = Auth::user()->roles;
            if ($role === 'admin' || $role === 'teacher') {
                return $next($request);
            } else {
                return redirect()->route('signin')->with('custom_error', 'Unauthorized Access, Please Sign-in.');
            }
        } else {
            return redirect()->route('signin')->with('custom2_error', 'Please sign in to access this page.');
        }
    }
}

