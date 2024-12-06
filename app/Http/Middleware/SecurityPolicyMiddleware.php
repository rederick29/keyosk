<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityPolicyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Continue the request and get the response from the next middleware
        $response = $next($request);

        // Deny framing of the website (clickjacking protection)
        $response->headers->set('X-Frame-Options', 'DENY');

        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Return the modified response
        return $response;
    }
}
