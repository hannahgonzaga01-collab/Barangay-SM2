<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Resident;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name'  => ['required', 'string', 'max:255'],
            'last_name'   => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'email'       => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'    => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Build full name
        $fullName = trim($request->first_name . ' ' . ($request->middle_name ? $request->middle_name . ' ' : '') . $request->last_name);

        $user = User::create([
            'name'        => $fullName,
            'first_name'  => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name'   => $request->last_name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => 'resident',
            'status'      => 'active',
            'is_active'   => 1,
            'is_voter'    => $request->boolean('is_voter'),
        ]);

        $user->recordPasswordHistory($user->password);

        // ── Auto-link to resident record if name matches ──
        $resident = Resident::where('first_name', $request->first_name)
            ->where('last_name', $request->last_name)
            ->whereNull('user_id')
            ->first();

        if ($resident) {
            $resident->update(['user_id' => $user->id]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('resident.index', absolute: false));
    }
}
