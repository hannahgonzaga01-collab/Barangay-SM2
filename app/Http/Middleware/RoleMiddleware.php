<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ito yung kulang mo kaya may red lines!
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Check kung logged in ang user
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Check kung ang role ng user ay kasama sa allowed roles
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
