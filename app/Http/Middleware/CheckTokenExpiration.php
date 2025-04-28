<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['message' => 'Token manquant'], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if ($accessToken && $accessToken->expires_at && now()->greaterThan($accessToken->expires_at)) {
            return response()->json(['message' => 'Token expiré'], 401);
        }

        return $next($request);
    }
}
