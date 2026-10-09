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

        // If an authenticated staff/admin tries to access the resident portal, block with 403 Forbidden
        if ($user && $user->role !== 'resident') {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'error'   => 'Forbidden',
                    'message' => 'Unauthorized access. Staff accounts are not permitted to access the Resident Portal.'
                ], 403);
            }
            abort(403, 'Wala kayong pahintulot na ma-access ang Resident Portal gamit ang Department Staff / Admin account.');
        }

        // If not authenticated, allow guests to view the landing page and public notices
        if (!$user) {
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
