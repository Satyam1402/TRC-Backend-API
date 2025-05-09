<?php

namespace App\Http\Middleware;

use Closure;

class FixAuthHeader
{
    public function handle($request, Closure $next)
    {
        if (!$request->headers->has('Authorization') && isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $request->headers->set('Authorization', $_SERVER['REDIRECT_HTTP_AUTHORIZATION']);
        }

        return $next($request);
    }
}
