<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Resident;
use App\Services\ResidentMatcher;
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

    public function verifyResident(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
        ]);

        $matchResult = ResidentMatcher::match(
            $request->first_name,
            $request->last_name,
            $request->birthday
        );

        $resident = $matchResult['matched_resident'];
        $isExact = $matchResult['is_exact'];

        if ($resident && $resident->user_id && $isExact) {
            return response()->json([
                'success' => false,
                'message' => 'An account is already linked to this resident record in our Masterlist. If this is you, please sign in or use forgot password.'
            ], 422);
        }

        // Accept all registrations without hard-failing
        return response()->json([
            'success' => true,
            'is_exact' => $isExact,
            'confidence_score' => $matchResult['confidence_score'],
            'message' => $isExact
                ? 'Resident record verified in Masterlist.'
                : 'Registration will be queued for smart Office Admin verification.'
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'birthday' => ['required', 'date', 'before_or_equal:' . now()->subYears(15)->toDateString()],
            'is_voter' => ['required', 'in:0,1'],
            'precinct_no' => ['required_if:is_voter,1', 'nullable', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'voter_id_photo' => ['nullable', 'image', 'max:5120'], // Max 5MB Proof/ID upload
        ]);

        // Build full name
        $fullName = trim($request->first_name . ' ' . ($request->middle_name ? $request->middle_name . ' ' : '') . $request->last_name);

        // Handle Photo Upload
        $photoPath = null;
        if ($request->hasFile('voter_id_photo')) {
            $photoPath = $request->file('voter_id_photo')->store('voter_ids', 'public');
        }

        // ── 1. Smart Masterlist Fuzzy Matching ──
        $matchResult = ResidentMatcher::match(
            $request->first_name,
            $request->last_name,
            $request->birthday
        );

        $matchedResident = $matchResult['matched_resident'];
        $isExactMatch = $matchResult['is_exact'] && $matchedResident && !$matchedResident->user_id;

        $userStatus = $isExactMatch ? 'active' : 'pending_verification';
        $voterStatus = $isExactMatch ? ($request->boolean('is_voter') ? 'approved' : 'approved') : 'pending';
        $isActive = $isExactMatch ? 1 : 0;

        $user = User::create([
            'name' => $fullName,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'resident',
            'status' => $userStatus,
            'is_active' => $isActive,
            'is_voter' => $request->boolean('is_voter'),
            'precinct_no' => $request->boolean('is_voter') ? strtoupper(trim($request->precinct_no)) : null,
            'voter_id_photo' => $photoPath,
            'voter_status' => $voterStatus,
            'birthday' => $request->birthday,
        ]);

        $user->recordPasswordHistory($user->password);

        if ($isExactMatch && $matchedResident) {
            // Link to the exact found resident record
            $matchedResident->update([
                'user_id' => $user->id,
                'is_voter' => $request->boolean('is_voter'),
                'precinct_no' => $request->boolean('is_voter') ? strtoupper(trim($request->precinct_no)) : null,
                'voter_status' => 'approved',
                'verification_status' => 'approved',
            ]);

            event(new Registered($user));
            Auth::login($user);
            return redirect()->route('resident.index')->with('success', 'Welcome! Your account has been verified and linked to our Barangay Masterlist.');
        }

        event(new Registered($user));

        // For pending verification, inform user and redirect to login with status notice
        return redirect()->route('login')->with('status', 'Your registration has been submitted for Masterlist verification. The Office Admin will review your account shortly.');
    }
}
