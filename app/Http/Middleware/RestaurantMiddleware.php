<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RestaurantMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('restaurant')->check()) {
            return redirect()->route('restaurant.login')->withErrors('Silakan login sebagai resto.');
        }

        return $next($request);
    }
}
