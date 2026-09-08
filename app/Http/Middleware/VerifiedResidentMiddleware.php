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

        // Check if resident is linked to verified masterlist record or approved
        $isLegitimate = \App\Models\Resident::where('user_id', $user->id)->exists();

        if (!$isLegitimate && $user->voter_status !== 'approved' && $user->status !== 'active') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $message = 'Non-legitimate residents cannot access the portal. You can use the public homepage to request documents or file complaint reports. If you are a resident and cannot log in, please visit the Barangay Office.';
            
            if ($user->status === 'pending_verification' || $user->voter_status === 'pending') {
                $message = 'Your account registration is currently pending Masterlist verification by the Barangay Office Admin. You will be able to access the portal once verified.';
            } elseif ($user->voter_status === 'declined' || $user->status === 'declined') {
                $message = 'Ang iyong registration ay tinanggihan. Dahilan: ' . ($user->decline_reason ?? 'Hindi tumutugma sa masterlist.');
            }

            return redirect()->route('login')->with('error', $message);
        }

        return $next($request);
    }
}
