<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Symfony\Component\HttpFoundation\Response;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // User is not authenticated, redirect to /sa with an error message
            return redirect('/sa')->with('error', 'You must be logged in to access this page')->withInput();
        }

        // User is authenticated, allow the request to proceed
        return $next($request);
    }
}
