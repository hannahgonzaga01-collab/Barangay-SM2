<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordOtpMail;
use Carbon\Carbon;

class StaffPasswordController extends Controller
{
    // The secret answer that only barangay officials know
    // Change this to whatever secret you want
    const SECRET_ANSWER = 'MARVIN M. BENIS';

    public function show()
    {
        return view('staff.change-password');
    }

    public function sendOtp(Request $request)
    {
        $user = auth()->user();
        $email = $request->input('email') ?: $user->email;
        
        if (!$email) {
            return response()->json(['success' => false, 'message' => 'No email address found for this account.']);
        }

        $otp = (string) rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        try {
            Mail::to($email)->send(new PasswordOtpMail($otp));
            return response()->json(['success' => true, 'message' => 'OTP has been sent to ' . $email . ' (valid for 10 minutes).']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP email: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'new_password' => ['required', 'string', 'min:8', 'max:16', 'not_regex:/\s/', 'confirmed', new \App\Rules\NotRecentPassword($user)],
        ];

        $inputOtp = $request->input('otp') ?? $request->input('security_answer');

        if (!empty($inputOtp)) {
            // Verify OTP for resident or staff
            if (!$user->otp || strtoupper(trim($inputOtp)) !== strtoupper($user->otp) || ($user->otp_expires_at && Carbon::now()->isAfter($user->otp_expires_at))) {
                return back()->withErrors(['otp' => 'Invalid or expired OTP code. Please check your email or click Send OTP again.']);
            }

            // Clear OTP after successful verification
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();
        } elseif ($request->filled('current_password')) {
            // Alternatively allow current password for staff
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
        } else {
            return back()->withErrors(['otp' => 'Please enter the 6-digit OTP code sent to your email.']);
        }

        $request->validate($rules, [
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.max' => 'New password must not exceed 16 characters.',
            'new_password.not_regex' => 'New password must be one word and cannot contain spaces.',
        ]);

        // Update password
        $user->update(['password' => Hash::make($request->new_password)]);
        $user->recordPasswordHistory($user->password);

        return back()->with('success', 'Password has been updated successfully!');
    }
}
