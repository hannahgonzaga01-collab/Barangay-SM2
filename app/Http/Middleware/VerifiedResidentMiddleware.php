<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifiedResidentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If not a resident, let other middlewares handle it
        if (!$user || $user->role !== 'resident') {
            return $next($request);
        }

        // Check if resident is deactivated by admin (allow declined residents to access dashboard to update profile/re-upload)
        if (!$user->is_active && $user->status !== 'declined' && $user->voter_status !== 'declined') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Ang iyong account ay hindi aktibo.');
        }

        // Active, pending_verification, and declined residents are permitted through to view the dashboard!
        return $next($request);
    }
}
