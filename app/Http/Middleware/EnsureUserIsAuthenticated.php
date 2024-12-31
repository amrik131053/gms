<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            // return view('admin.index');
 // Adjust route as needed
        }

        return $next($request);
    }
}
