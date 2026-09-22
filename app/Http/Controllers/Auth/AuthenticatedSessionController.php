<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Check kung active ang account (allow declined residents through so they can see decline reason and update profile)
        if (!$user->is_active && $user->status !== 'declined' && $user->voter_status !== 'declined') {
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('error', 'Your account is deactivated.');
        }

        $request->session()->flash('login_welcome', true);

        // Role-Based Redirection — walang intended() para hindi mag-redirect sa maling page
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'justice':
                return redirect()->route('justice.dashboard');
            case 'vawc':
                return redirect()->route('vawc.dashboard');
            case 'peace':
                return redirect()->route('peace.dashboard');
            case 'office':
                return redirect()->route('office.index');
            case 'resident':
                return redirect()->route('resident.index');
            default:
                return redirect()->route('login')->with('error', 'Unknown role. Please contact the administrator.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
