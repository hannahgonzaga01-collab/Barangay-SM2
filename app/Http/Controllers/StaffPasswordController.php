<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffPasswordController extends Controller
{
    // The secret answer that only barangay officials know
    // Change this to whatever secret you want
    const SECRET_ANSWER = 'MARVIN M. BENIS';

    public function show()
    {
        return view('staff.change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password'  => 'required',
            'security_answer'   => 'required|string',
            'new_password'      => ['required', 'min:8', 'confirmed', new \App\Rules\NotRecentPassword(auth()->user())],
        ]);

        $user = auth()->user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Check security question answer (case-insensitive)
        if (strtoupper(trim($request->security_answer)) !== strtoupper(self::SECRET_ANSWER)) {
            return back()->withErrors(['security_answer' => 'Incorrect answer. Please contact the Punong Barangay.']);
        }

        // Update password
        $user->update(['password' => Hash::make($request->new_password)]);
        $user->recordPasswordHistory($user->password);

        return redirect()->route('dashboard')
            ->with('success', 'Password changed successfully.');
    }
}
