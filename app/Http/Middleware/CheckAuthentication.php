<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthentication
{
    // public function handle(Request $request, Closure $next): Response
    // {
    //     $token = $request->session()->get('api_token');
    //     if (!$token)
    //     {
    //         return redirect('/');
    //     }
       
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->session()->get('api_token');
        if (!$token) {
            $token = $request->cookie('api_token');
            if ($token) {
                $request->session()->put('api_token', $token);
            }
        }
        if (!$token) {
            return redirect('/');
        }
        return $next($request);
    }
}
