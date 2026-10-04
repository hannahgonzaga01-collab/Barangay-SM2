<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Resident;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Identify protected user codes (e.g. hannahgonzaga01 test account)
        $hannahUser = User::where('email', 'like', '%hannahgonzaga01%')->first();
        $protectedCodes = [];
        if ($hannahUser && $hannahUser->resident_code) {
            $protectedCodes[] = $hannahUser->resident_code;
        }

        // 2. Unlink any official masterlist residents (RSM-%) so real residents can register themselves
        Resident::where('resident_code', 'like', 'RSM-%')
            ->whereNotIn('resident_code', $protectedCodes)
            ->update(['user_id' => null]);

        // 3. Ensure 5 Dedicated Dummy Resident Accounts for Evaluation/Testing exist
        for ($i = 1; $i <= 5; $i++) {
            $email = $i === 1 ? 'resident_eval@brgysm.ph' : "resident_eval{$i}@brgysm.ph";
            $code  = sprintf("RES-DUMMY-%03d", $i);

            $user = User::firstOrNew(['email' => $email]);
            $user->name              = "Demo Eval Resident {$i}";
            $user->first_name        = "Demo";
            $user->middle_name       = "Eval";
            $user->last_name         = "Resident {$i}";
            $user->password          = Hash::make('Password123');
            $user->role              = 'resident';
            $user->status            = 'active';
            $user->is_active         = true;
            $user->resident_code     = $code;
            $user->contact_number    = '0917' . sprintf('%07d', 3000000 + $i);
            $user->gender            = ($i % 2 === 0 ? 'Female' : 'Male');
            $user->civil_status      = 'Single';
            $user->birthday          = '1995-05-15';
            $user->birthplace        = 'Dasmariñas, Cavite';
            $user->address           = "Purok {$i}, Barangay San Miguel II";
            $user->occupation        = 'Evaluator / Tester';
            $user->is_voter          = true;
            $user->voter_status      = 'verified';
            $user->is_non_voter      = false;
            $user->security_question = "What is your mother's maiden name?";
            $user->security_answer   = 'Santos';
            $user->save();

            $dummyResident = Resident::firstOrNew(['resident_code' => $code]);
            $dummyResident->user_id           = $user->id;
            $dummyResident->first_name        = "Demo";
            $dummyResident->middle_name       = "Eval";
            $dummyResident->last_name         = "Resident {$i}";
            $dummyResident->birthday          = '1995-05-15';
            $dummyResident->birthplace        = 'Dasmariñas, Cavite';
            $dummyResident->gender            = ($i % 2 === 0 ? 'Female' : 'Male');
            $dummyResident->civil_status      = 'Single';
            $dummyResident->address           = "Purok {$i}, Barangay San Miguel II";
            $dummyResident->contact_number    = '0917' . sprintf('%07d', 3000000 + $i);
            $dummyResident->occupation        = 'Evaluator / Tester';
            $dummyResident->is_voter          = true;
            $dummyResident->voter_status      = 'verified';
            $dummyResident->is_non_voter      = false;
            $dummyResident->age               = 30;
            $dummyResident->is_household_head = true;
            $dummyResident->household_id      = "HH-DUMMY-{$i}";
            $dummyResident->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Safe rollback
    }
};
