<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    /**
     * Send an OTP code to a mobile number or email address.
     */
    public function send(Request $request): JsonResponse
    {
        $request->validate([
            'recipient' => ['required', 'string'],
            'purpose'   => ['nullable', 'string', 'in:register,login,change_phone,change_email,change_password,profile'],
        ]);

        $recipient = trim($request->recipient);
        $purpose = $request->purpose ?? 'auth';
        $isEmail = str_contains($recipient, '@');

        // Validation & Uniqueness Guardrails
        if ($isEmail) {
            if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mangyaring maglagay ng wastong email address.'
                ], 422);
            }

            if ($purpose === 'register' && User::where('email', strtolower($recipient))->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mayroon nang account na nakarehistro gamit ang email na ito. Mangyaring mag-log in na lamang.'
                ], 422);
            }

            if ($purpose === 'change_email') {
                $exists = User::where('email', strtolower($recipient))
                    ->where('id', '!=', auth()->id())
                    ->exists();
                if ($exists) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Ang email address na ito ay ginagamit na ng ibang residente.'
                    ], 422);
                }
            }
        } else {
            $normalizedPhone = OtpService::normalizePhoneNumber($recipient);
            if (!OtpService::isValidPhoneNumber($normalizedPhone)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mangyaring maglagay ng wastong 11-digit mobile number (e.g. 09123456789).'
                ], 422);
            }

            // Strictly 1 account = 1 mobile number!
            if ($purpose === 'register' && User::where('contact_number', $normalizedPhone)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ang mobile number na ito ay nakakabit na sa isang account. Bawal ang paulit-ulit na numero sa bawat account.'
                ], 422);
            }

            if ($purpose === 'change_phone') {
                $exists = User::where('contact_number', $normalizedPhone)
                    ->where('id', '!=', auth()->id())
                    ->exists();
                if ($exists) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Ang mobile number na ito ay pagmamay-ari na ng ibang rehistradong account.'
                    ], 422);
                }
            }

            if ($purpose === 'login') {
                $userExists = User::where('contact_number', $normalizedPhone)->exists();
                if (!$userExists) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Walang nahanap na account gamit ang mobile number na ito. Mangyaring mag-register muna.'
                    ], 404);
                }
            }

            $recipient = $normalizedPhone;
        }

        $result = OtpService::sendOtp($recipient, $purpose);

        return response()->json($result);
    }

    /**
     * Verify an OTP code.
     */
    public function verify(Request $request): JsonResponse
    {
        $request->validate([
            'recipient' => ['required', 'string'],
            'otp_code'  => ['required', 'string'],
            'purpose'   => ['nullable', 'string'],
        ]);

        $recipient = trim($request->recipient);
        $purpose = $request->purpose ?? 'auth';
        $isEmail = str_contains($recipient, '@');
        $cleanRecipient = $isEmail ? strtolower($recipient) : OtpService::normalizePhoneNumber($recipient);

        $valid = OtpService::verifyOtp($cleanRecipient, $request->otp_code, $purpose);

        if (!$valid) {
            return response()->json([
                'success' => false,
                'message' => 'Mali o expired na ang inilagay na 6-digit OTP code. Pakisubukang muli.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Matagumpay na na-verify ang OTP!'
        ]);
    }

    /**
     * Passwordless Login using Mobile Number + OTP.
     */
    public function loginWithOtp(Request $request)
    {
        $request->validate([
            'contact_number' => ['required', 'string'],
            'otp_code'       => ['required', 'string'],
        ]);

        $cleanPhone = OtpService::normalizePhoneNumber($request->contact_number);
        if (!OtpService::isValidPhoneNumber($cleanPhone)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Wastong 11-digit mobile number ang kailangan.']);
        }

        $isValid = OtpService::verifyOtp($cleanPhone, $request->otp_code, 'login');
        if (!$isValid) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Mali o expired na ang One-Time PIN (OTP).']);
        }

        $user = User::where('contact_number', $cleanPhone)->first();
        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Walang nahanap na account para sa numerong ito.']);
        }

        if (!$user->is_active && $user->status !== 'declined' && $user->voter_status !== 'declined') {
            return redirect()->route('login')->with('error', 'Your account is deactivated.');
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        try {
            $user->forceFill(['last_login_at' => now()])->saveQuietly();
        } catch (\Throwable $e) {}

        $request->session()->flash('login_welcome', true);

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
            default:
                return redirect()->route('resident.index');
        }
    }
}
