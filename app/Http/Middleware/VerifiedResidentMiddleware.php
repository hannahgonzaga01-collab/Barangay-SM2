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

        // Check if resident is deactivated or explicitly declined
        if (!$user->is_active || $user->status === 'declined' || $user->voter_status === 'declined') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $message = 'Ang iyong account ay tinanggihan o hindi aktibo.';
            if ($user->decline_reason) {
                $message = 'Ang iyong registration ay tinanggihan ng Barangay Office. Dahilan: ' . $user->decline_reason;
            }

            return redirect()->route('login')->with('error', $message);
        }

        // Both active and pending_verification residents are permitted through to view the dashboard!
        return $next($request);
    }
}
