<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->user()->hasRole($role)) {
            return $next($request);
        }
        throw UnauthorizedException::forRoles([$role]);
    }
}
