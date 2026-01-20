<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
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
        $response = $next($request);

        // HSTS - Strict Transport Security (1 year)
        $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // Prevent MIME type sniffing
        $response->header('X-Content-Type-Options', 'nosniff');

        // XSS Protection
        $response->header('X-XSS-Protection', '1; mode=block');

        // Prevent clickjacking
        $response->header('X-Frame-Options', 'SAMEORIGIN');

        // Referrer Policy
        $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions Policy (formerly Feature Policy)
        $response->header('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        return $response;
    }
}
