<?php


namespace App\Http\Middleware;

use App\Models\Tokens;
use Closure;
use http\Client\Response;

class AuthAPI
{
    public function handle($request, Closure $next)
    {
        if (Tokens::checkToken($request->bearerToken())) {
            return $next($request);
        }
        return response()->json([
            'status' => false
        ]);
    }
}
