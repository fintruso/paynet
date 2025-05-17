<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AuthWithTokenQuery
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->query('api_token');

        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken) {
                auth()->loginUsingId($accessToken->tokenable_id);
            }
        }

        return $next($request);
    }
}
