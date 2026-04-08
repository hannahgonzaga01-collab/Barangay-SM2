<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class SecurityQuestionController extends Controller
{
    /**
     * Display the security question screen.
     */
    public function show(Request $request)
    {
        $email = session('reset_email') ?? old('email');

        if (!$email) {
            return redirect()->route('password.request');
        }

        $user = User::where('email', $email)->first();

        if (!$user || empty($user->security_question)) {
            return redirect()->route('password.request')->withErrors(['email' => 'Invalid request.']);
        }

        // Keep the email in session in case verification fails
        session()->keep(['reset_email']);

        return view('auth.security-question', [
            'email' => $email,
            'question' => $user->security_question
        ]);
    }

    /**
     * Verify the security answer and manually generate a reset token.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'security_answer' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)->first();

        // If something goes wrong fetching the user or they have no answer set
        if (!$user || empty($user->security_answer)) {
            return redirect()->route('password.request')->withErrors(['email' => 'Invalid request. Please try again.']);
        }

        // Validate the answer
        $inputAnswer = strtolower(trim($request->security_answer));
        $correctAnswer = strtolower(trim($user->security_answer));

        if ($inputAnswer === $correctAnswer) {
            // Success: manually grant a reset token
            $token = Password::broker()->createToken($user);
            
            // Redirect to the regular reset password view with the token prefilled
            return redirect()->route('password.reset', ['token' => $token, 'email' => $user->email]);
        }

        // Keep email session alive so they can try again
        session()->flash('reset_email', $request->email);

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['security_answer' => 'The answer you provided is incorrect. Please try again.']);
    }
}
