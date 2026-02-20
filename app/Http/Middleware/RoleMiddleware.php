<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::guard($role)->check()) {
            return redirect()->route($role . '-login')->with('error', 'Unauthorized access!');
        }
        return $next($request);
    }
}