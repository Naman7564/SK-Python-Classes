<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Content Security Policy to block mixed content (HTTP scripts on HTTPS pages)
        // Using 'upgrade-insecure-requests' to automatically upgrade HTTP to HTTPS
        $response->headers->set(
            'Content-Security-Policy',
            "upgrade-insecure-requests; " .
            "default-src 'self' https:; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https:; " .
            "style-src 'self' 'unsafe-inline' https:; " .
            "img-src 'self' data: https:; " .
            "font-src 'self' https://fonts.bunny.net https://fonts.googleapis.com data:; " .
            "connect-src 'self' https:; " .
            "frame-ancestors 'self'; " .
            "base-uri 'self'; " .
            "form-action 'self';"
        );

        // Additional security headers
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        return $response;
    }
}

