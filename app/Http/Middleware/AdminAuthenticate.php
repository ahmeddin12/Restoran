<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
  /**
   * Handle an incoming request.
   */
  public function handle(Request $request, Closure $next)
  {
    if (! Auth::guard('admin')->check()) {
      return redirect()->route('admins.login');
    }

    return $next($request);
  }
}
