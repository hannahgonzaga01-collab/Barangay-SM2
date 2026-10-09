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
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('login')->with('error', 'Mangyaring mag-log in muna upang ma-access ang pahinang ito.');
        }

        // 2. Check kung ang role ng user ay kasama sa allowed roles
        $userRole = Auth::user()->role;
        if (!in_array($userRole, $roles)) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['message' => 'Unauthorized access.'], 403);
            }

            $redirectRoute = match ($userRole) {
                'admin'   => 'admin.dashboard',
                'office'  => 'office.index',
                'justice' => 'justice.dashboard',
                'vawc'    => 'vawc.dashboard',
                'peace'   => 'peace.dashboard',
                default   => 'resident.index',
            };

            return redirect()->route($redirectRoute)->with('error', 'Wala kayong pahintulot na buksan ang pahinang ito (Access Denied).');
        }

        return $next($request);
    }
}
