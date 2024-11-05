<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the response from the next middleware/request handler
        $response = $next($request);

        // Set security headers
        $response->headers->set('Content-Security-Policy', "frame-ancestors 'none'; default-src 'self'; script-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; upgrade-insecure-requests;");
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Return the modified response
        return $response;
    }
}