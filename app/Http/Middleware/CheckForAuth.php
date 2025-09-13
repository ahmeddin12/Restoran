<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckForAuth
{
    public function handle(Request $request, Closure $next)
    {
        // If already logged in as admin, redirect to dashboard
        if ($request->is('admins/login') && Auth::guard('admin')->check()) {
            return redirect()->route('admins.dashboard');
        }

        return $next($request);
    }
}
