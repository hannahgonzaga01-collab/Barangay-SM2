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
        
        if (!$user->email) {
            return response()->json(['success' => false, 'message' => 'No email address found for this account.']);
        }

        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        try {
            Mail::to($user->email)->send(new PasswordOtpMail($otp));
            return response()->json(['success' => true, 'message' => 'OTP has been sent to your email.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send email. Please try again later.']);
        }
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $isResident = $user->role === 'resident';

        $rules = [
            'security_answer'   => 'required|string',
            'new_password'      => ['required', 'min:8', 'confirmed', new \App\Rules\NotRecentPassword($user)],
        ];

        if (!$isResident) {
            $rules['current_password'] = 'required';
        }

        $request->validate($rules);

        if (!$isResident) {
            // Check current password for staff
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            // Check security question for staff (custom answer from admin or fallback to system default)
            $expectedAnswer = !empty($user->security_answer) ? $user->security_answer : self::SECRET_ANSWER;
            if (strtolower(trim($request->security_answer)) !== strtolower(trim($expectedAnswer))) {
                return back()->withErrors(['security_answer' => 'Incorrect answer. Please check your security question or contact the Administrator.']);
            }
        } else {
            // Check OTP for residents
            if (!$user->otp || strtoupper(trim($request->security_answer)) !== strtoupper($user->otp) || ($user->otp_expires_at && Carbon::now()->isAfter($user->otp_expires_at))) {
                return back()->withErrors(['security_answer' => 'Invalid or expired OTP. Please try again.']);
            }

            // Clear OTP after successful verification
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();
        }

        // Update password
        $user->update(['password' => Hash::make($request->new_password)]);
        $user->recordPasswordHistory($user->password);

        return redirect()->route('dashboard')
            ->with('success', 'Password changed successfully.');
    }
}
