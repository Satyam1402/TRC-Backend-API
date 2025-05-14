<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserToken;

class AuthTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $userId = UserToken::validateToken($token);

        if (!$userId) {
            return response()->json(['error' => 'Invalid or expired token'], 401);
        }

        $request->merge(['user_id' => $userId]);

        return $next($request);
    }
}
