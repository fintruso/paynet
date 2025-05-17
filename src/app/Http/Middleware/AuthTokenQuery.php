<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthTokenQuery
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->query('token');

        if ($token !== 'seu_token_aqui') {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}