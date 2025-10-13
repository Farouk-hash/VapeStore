<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkTokensExpirations
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->user()?->currentAccessToken();
        if ($token && $token->expires_at && now()->greaterThan($token->expires_at)) {
            // Token expired — delete it
            $token->delete();

            return response()->json([
                'message' => 'Token expired. Please log in again.'
            ], 401);
        }
        
        return $next($request);
    }
}
