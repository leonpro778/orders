<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::user()->checkRole($role))
        {
            // TODO - change redirect to 'no permissions page'
            return redirect()->to('welcome');
        }

        return $next($request);
    }
}
