<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoCacheHtml
{
    /**
     * Prevent browsers/proxies from caching HTML documents.
     *
     * This avoids cases where some clients keep an old HTML page that references
     * old Vite hashed assets (which may be removed/changed on deploy), resulting
     * in "missing CSS" on certain devices/browsers.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \Symfony\Component\HttpFoundation\Response $response */
        $response = $next($request);

        // Only apply for GET HTML responses in production.
        if (!app()->environment('production')) {
            return $response;
        }

        if ($request->method() !== 'GET') {
            return $response;
        }

        $contentType = (string) $response->headers->get('Content-Type', '');
        if (!str_starts_with(strtolower($contentType), 'text/html')) {
            return $response;
        }

        // Strong no-cache for HTML. Assets under /build should still be cached normally.
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }
}

