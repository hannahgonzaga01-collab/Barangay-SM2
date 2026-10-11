<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OtpService
{
    /**
     * Clean and normalize Philippine mobile numbers to 09XXXXXXXXX format.
     */
    public static function normalizePhoneNumber(?string $phone): ?string
    {
        if (!$phone) {
            return null;
        }

        // Strip non-digits except leading +
        $cleaned = preg_replace('/[^0-9]/', '', $phone);

        // Convert +639XXXXXXXXX or 639XXXXXXXXX to 09XXXXXXXXX
        if (str_starts_with($cleaned, '63') && strlen($cleaned) === 12) {
            $cleaned = '0' . substr($cleaned, 2);
        } elseif (strlen($cleaned) === 10 && str_starts_with($cleaned, '9')) {
            $cleaned = '0' . $cleaned;
        }

        return $cleaned;
    }

    /**
     * Validate Philippine 11-digit mobile number format.
     */
    public static function isValidPhoneNumber(?string $phone): bool
    {
        $normalized = self::normalizePhoneNumber($phone);
        return !empty($normalized) && preg_match('/^09\d{9}$/', $normalized) === 1;
    }

    /**
     * Generate a 6-digit OTP code and store in cache with 5 minutes TTL.
     */
    public static function generateOtp(string $recipient, string $purpose = 'auth'): string
    {
        $cleanRecipient = str_contains($recipient, '@') 
            ? strtolower(trim($recipient)) 
            : self::normalizePhoneNumber($recipient);

        $code = sprintf('%06d', mt_rand(100000, 999999));
        $cacheKey = "otp_{$purpose}_{$cleanRecipient}";

        Cache::put($cacheKey, [
            'code' => $code,
            'expires_at' => now()->addMinutes(5)->timestamp,
        ], now()->addMinutes(5));

        // Also update user record if user exists with this email or phone
        $user = str_contains($cleanRecipient, '@')
            ? User::where('email', $cleanRecipient)->first()
            : User::where('contact_number', $cleanRecipient)->first();

        if ($user) {
            $user->otp = $code;
            $user->otp_expires_at = now()->addMinutes(5);
            $user->saveQuietly();
        }

        return $code;
    }

    /**
     * Send OTP via SMS or Email (supports Mock Mode and Semaphore Gateway).
     */
    public static function sendOtp(string $recipient, string $purpose = 'auth'): array
    {
        $isEmail = str_contains($recipient, '@');
        $cleanRecipient = $isEmail 
            ? strtolower(trim($recipient)) 
            : self::normalizePhoneNumber($recipient);

        if (!$isEmail && !self::isValidPhoneNumber($cleanRecipient)) {
            return [
                'success' => false,
                'message' => 'Mangyaring maglagay ng wastong 11-digit mobile number (e.g. 09123456789).'
            ];
        }

        $code = self::generateOtp($cleanRecipient, $purpose);

        if ($isEmail) {
            return self::sendEmailOtp($cleanRecipient, $code, $purpose);
        } else {
            return self::sendSmsOtp($cleanRecipient, $code, $purpose);
        }
    }

    /**
     * Send SMS OTP via PhilSMS, Semaphore, or fallback to Mock OTP.
     */
    protected static function sendSmsOtp(string $phone, string $code, string $purpose): array
    {
        $message = "Barangay San Miguel II: Ang inyong One-Time PIN (OTP) ay {$code}. Valid for 5 minutes. Huwag itong ibigay kaninuman.";

        // Normalize number to Philippine international format: 639XXXXXXXXX
        $cleanDigits = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($cleanDigits, '0') && strlen($cleanDigits) === 11) {
            $formattedRecipient = '63' . substr($cleanDigits, 1);
        } elseif (strlen($cleanDigits) === 10 && str_starts_with($cleanDigits, '9')) {
            $formattedRecipient = '63' . $cleanDigits;
        } else {
            $formattedRecipient = $cleanDigits;
        }

        $smsSent = false;

        // 1. PhilSMS Gateway (v3) - Priority
        $philsmsToken = config('services.philsms.token', env('PHILSMS_API_TOKEN', '5139|o8YEh29qrTb3PsAXd2uDwqWxCpNrS5jVSJTQZn4p35400c7b'));
        $philsmsSender = config('services.philsms.sender_id', env('PHILSMS_SENDER_ID', 'PhilSMS'));

        if (!empty($philsmsToken) && $philsmsToken !== 'mock') {
            try {
                $response = Http::timeout(10)->withHeaders([
                    'Authorization' => 'Bearer ' . $philsmsToken,
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ])->post('https://dashboard.philsms.com/api/v3/sms/send', [
                    'recipient' => $formattedRecipient,
                    'sender_id' => $philsmsSender,
                    'type'      => 'plain',
                    'message'   => $message,
                ]);

                $resData = $response->json();
                Log::info("[PhilSMS API Response]", ['body' => $resData, 'status' => $response->status(), 'to' => $formattedRecipient]);

                if ($response->successful() && isset($resData['status']) && $resData['status'] === 'success') {
                    $smsSent = true;
                    Log::info("[PhilSMS SMS Sent] To: {$formattedRecipient} | Code: {$code}");
                } else {
                    Log::warning("[PhilSMS Warning] SMS not delivered: " . json_encode($resData));
                }
            } catch (\Throwable $e) {
                Log::error("[PhilSMS Gateway Error] " . $e->getMessage());
            }
        }

        // 2. Semaphore Gateway (Alternate)
        if (!$smsSent) {
            $apiKey = config('services.semaphore.api_key', env('SEMAPHORE_API_KEY'));
            $senderName = config('services.semaphore.sender_name', env('SEMAPHORE_SENDER_NAME', 'BRGY-SM2'));

            if (!empty($apiKey) && $apiKey !== 'mock') {
                try {
                    $response = Http::timeout(10)->post('https://api.semaphore.co/api/v4/messages', [
                        'apikey'     => $apiKey,
                        'number'     => $phone,
                        'message'    => $message,
                        'sendername' => $senderName,
                    ]);

                    if ($response->successful()) {
                        $smsSent = true;
                        Log::info("[SMS OTP Sent] To: {$phone} via Semaphore");
                    } else {
                        Log::warning("[SMS API Warning] Failed response: " . $response->body());
                    }
                } catch (\Throwable $e) {
                    Log::error("[SMS Gateway Error] " . $e->getMessage());
                }
            }
        }

        // Session flash for banner consistency
        session()->flash('mock_otp', $code);
        session()->flash('mock_recipient', $phone);

        // Dual Mode: Return code for on-screen auto-fill & visual banner while real SMS is delivered
        return [
            'success'  => true,
            'mock'     => true,
            'code'     => $code,
            'sms_sent' => $smsSent,
            'message'  => $smsSent
                ? "Matagumpay na naipadala ang OTP sa iyong mobile phone ({$phone})!"
                : "Matagumpay na nabuo ang inyong 6-digit OTP verification code para sa mobile number ({$phone}).",
        ];
    }

    /**
     * Send Email OTP via Laravel Mail SMTP.
     */
    protected static function sendEmailOtp(string $email, string $code, string $purpose): array
    {
        try {
            Mail::raw(
                "Magandang araw!\n\nAng inyong One-Time PIN (OTP) para sa Barangay San Miguel II Digital Portal ay:\n\n👉 {$code} 👈\n\nIto ay may bisa sa loob ng 5 minuto. Huwag ibahagi ang verification code na ito kaninuman para sa seguridad ng inyong account.\n\nSalamat,\nBarangay San Miguel II Office",
                function ($m) use ($email, $code) {
                    $m->to($email)
                      ->subject("🔐 [Barangay SM2] Your Verification Code: {$code}");
                }
            );

            Log::info("[EMAIL OTP Sent] To: {$email}");
            return [
                'success' => true,
                'mock'    => false,
                'message' => "Naipadala ang 6-digit verification code sa iyong email address ({$email}). Pakitingnan ang iyong inbox o spam folder."
            ];
        } catch (\Throwable $e) {
            Log::error("[EMAIL OTP Error] " . $e->getMessage());

            // Fallback representation if mail server encounters SMTP connection delay
            session()->flash('mock_otp', $code);
            session()->flash('mock_recipient', $email);

            return [
                'success' => true,
                'mock'    => true,
                'code'    => $code,
                'message' => "Ang inyong 6-digit email verification code ay {$code}.",
            ];
        }
    }

    /**
     * Verify the supplied OTP code against cached / user record.
     */
    public static function verifyOtp(string $recipient, string $inputCode, string $purpose = 'auth'): bool
    {
        $cleanInput = trim($inputCode);
        if (empty($cleanInput)) {
            return false;
        }

        $isEmail = str_contains($recipient, '@');
        $cleanRecipient = $isEmail 
            ? strtolower(trim($recipient)) 
            : self::normalizePhoneNumber($recipient);

        $cacheKey = "otp_{$purpose}_{$cleanRecipient}";
        $cached = Cache::get($cacheKey);

        // 1. Check Cache
        if ($cached && !empty($cached['code'])) {
            if ($cached['code'] === $cleanInput) {
                Cache::forget($cacheKey);
                return true;
            }
        }

        // 2. Check User DB column
        $user = $isEmail 
            ? User::where('email', $cleanRecipient)->first()
            : User::where('contact_number', $cleanRecipient)->first();

        if ($user && $user->otp === $cleanInput) {
            if (!$user->otp_expires_at || $user->otp_expires_at->isFuture()) {
                $user->otp = null;
                $user->otp_expires_at = null;
                $user->saveQuietly();
                return true;
            }
        }

        return false;
    }
}
