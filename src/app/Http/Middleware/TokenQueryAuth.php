<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TokenQueryAuth
{
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('token_query')->user();

        if (!$user) {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        return $next($request);
    }
}
