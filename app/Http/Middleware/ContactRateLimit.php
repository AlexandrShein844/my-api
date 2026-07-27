<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ContactRateLimit
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'contact-ip:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 10)) {
            return response()->json([
                'message' => 'Too many requests from your IP'
            ], 429);
        }

        RateLimiter::hit($key, 60);

        return $next($request);
    }
}