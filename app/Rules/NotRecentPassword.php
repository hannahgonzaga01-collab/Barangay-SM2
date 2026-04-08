<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class NotRecentPassword implements ValidationRule
{
    protected ?User $user;

    public function __construct(User $user = null)
    {
        $this->user = $user ?? auth()->user();
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->user || !$this->user->password_history) {
            return;
        }

        $history = json_decode($this->user->password_history, true);
        if (is_array($history)) {
            foreach ($history as $oldHash) {
                if (Hash::check($value, $oldHash)) {
                    $fail('Your new password cannot be the same as any of your previous 3 passwords.');
                    return;
                }
            }
        }
    }
}
