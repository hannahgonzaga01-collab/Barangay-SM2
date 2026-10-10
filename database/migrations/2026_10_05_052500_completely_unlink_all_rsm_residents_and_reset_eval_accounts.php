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
        // ── 1. GUARANTEE ALL OFFICIAL MASTERLIST RESIDENTS (RSM-%) ARE 100% UNLINKED ──
        // Official residents must NEVER be attached to test/dummy accounts!
        Resident::where('resident_code', 'like', 'RSM-%')->update(['user_id' => null]);

        // ── 2. ISOLATE AND FIX HANNAH'S PERSONAL TEST ACCOUNT ──
        $hannahUser = User::where('email', 'like', '%hannahgonzaga01%')->first();
        if ($hannahUser) {
            $hannahCode = 'RES-TEST-HANNAH';
            $hannahUser->resident_code = $hannahCode;
            $hannahUser->status        = 'active';
            $hannahUser->is_active     = true;
            $hannahUser->save();

            $hResident = Resident::firstOrNew(['resident_code' => $hannahCode]);
            $hResident->user_id           = $hannahUser->id;
            $hResident->first_name        = $hannahUser->first_name ?: 'Hannah';
            $hResident->last_name         = $hannahUser->last_name ?: 'Gonzaga';
            $hResident->gender            = $hannahUser->gender ?: 'Female';
            $hResident->birthday          = $hannahUser->birthday ?: '2000-01-01';
            $hResident->civil_status      = $hannahUser->civil_status ?: 'Single';
            $hResident->address           = $hannahUser->address ?: 'Barangay San Miguel II';
            $hResident->is_voter          = true;
            $hResident->voter_status      = 'verified';
            $hResident->is_non_voter      = false;
            $hResident->is_household_head = true;
            $hResident->household_id      = 'HH-TEST-HANNAH';
            $hResident->save();
        }

        // ── 3. RESET AND ISOLATE THE 5 SHARED RESIDENT EVAL ACCOUNTS ──
        $dummyList = [
            1 => ['email' => 'resident_eval@brgysm.ph', 'first' => 'Juan', 'middle' => 'Dela Cruz', 'gender' => 'Male'],
            2 => ['email' => 'resident_eval2@brgysm.ph', 'first' => 'Maria', 'middle' => 'Santos', 'gender' => 'Female'],
            3 => ['email' => 'resident_eval3@brgysm.ph', 'first' => 'Jose', 'middle' => 'Reyes', 'gender' => 'Male'],
            4 => ['email' => 'resident_eval4@brgysm.ph', 'first' => 'Angelica', 'middle' => 'Garcia', 'gender' => 'Female'],
            5 => ['email' => 'resident_eval5@brgysm.ph', 'first' => 'Carlo', 'middle' => 'Ramos', 'gender' => 'Male'],
        ];

        foreach ($dummyList as $i => $info) {
            $code  = sprintf("RES-DUMMY-%03d", $i);
            $email = $info['email'];

            $user = User::firstOrNew(['email' => $email]);
            $user->name              = "{$info['first']} Dummy";
            $user->first_name        = $info['first'];
            $user->middle_name       = $info['middle'];
            $user->last_name         = 'Dummy';
            $user->password          = Hash::make('Password123');
            $user->role              = 'resident';
            $user->status            = 'active';
            $user->is_active         = true;
            $user->resident_code     = $code;
            $user->contact_number    = '0917' . sprintf('%07d', 3000000 + $i);
            $user->gender            = $info['gender'];
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

            // Clear any lingering link from this user to any RSM-% resident
            Resident::where('user_id', $user->id)
                ->where('resident_code', 'like', 'RSM-%')
                ->update(['user_id' => null]);

            $dummyResident = Resident::firstOrNew(['resident_code' => $code]);
            $dummyResident->user_id           = $user->id;
            $dummyResident->first_name        = $info['first'];
            $dummyResident->middle_name       = $info['middle'];
            $dummyResident->last_name         = 'Dummy';
            $dummyResident->birthday          = '1995-05-15';
            $dummyResident->birthplace        = 'Dasmariñas, Cavite';
            $dummyResident->gender            = $info['gender'];
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

        // ── 4. RESET AND ISOLATE 10 EVALUATOR IT RESIDENT ACCOUNTS ──
        $evaluatorNames = [
            1  => ['first' => 'Paolo', 'middle' => 'Bautista', 'gender' => 'Male'],
            2  => ['first' => 'Christine', 'middle' => 'Mendoza', 'gender' => 'Female'],
            3  => ['first' => 'Mark', 'middle' => 'Aquino', 'gender' => 'Male'],
            4  => ['first' => 'Patricia', 'middle' => 'Dela Rosa', 'gender' => 'Female'],
            5  => ['first' => 'Rafael', 'middle' => 'Castro', 'gender' => 'Male'],
            6  => ['first' => 'Nicole', 'middle' => 'Flores', 'gender' => 'Female'],
            7  => ['first' => 'Miguel', 'middle' => 'Villanueva', 'gender' => 'Male'],
            8  => ['first' => 'Jasmine', 'middle' => 'Navarro', 'gender' => 'Female'],
            9  => ['first' => 'Antonio', 'middle' => 'Mercado', 'gender' => 'Male'],
            10 => ['first' => 'Bea', 'middle' => 'Salazar', 'gender' => 'Female'],
        ];

        for ($i = 1; $i <= 10; $i++) {
            $code  = sprintf("RES-EVAL-%03d", $i);
            $email = "evaluator{$i}@brgysm.ph";
            $info  = $evaluatorNames[$i];

            $user = User::firstOrNew(['email' => $email]);
            $user->name              = "{$info['first']} Dummy";
            $user->first_name        = $info['first'];
            $user->middle_name       = $info['middle'];
            $user->last_name         = 'Dummy';
            $user->password          = Hash::make('Password123');
            $user->role              = 'resident';
            $user->status            = 'active';
            $user->is_active         = true;
            $user->resident_code     = $code;
            $user->contact_number    = '0917' . sprintf('%07d', 1000000 + $i);
            $user->gender            = $info['gender'];
            $user->civil_status      = 'Single';
            $user->birthday          = '1995-05-15';
            $user->birthplace        = 'San Manuel';
            $user->address           = 'Zone ' . (($i % 7) + 1) . ', Barangay San Manuel';
            $user->occupation        = 'IT Evaluator';
            $user->is_voter          = true;
            $user->voter_status      = 'verified';
            $user->is_non_voter      = false;
            $user->save();

            Resident::where('user_id', $user->id)
                ->where('resident_code', 'like', 'RSM-%')
                ->update(['user_id' => null]);

            $resident = Resident::firstOrNew(['resident_code' => $code]);
            $resident->user_id        = $user->id;
            $resident->first_name     = $info['first'];
            $resident->middle_name    = $info['middle'];
            $resident->last_name      = 'Dummy';
            $resident->birthday       = '1995-05-15';
            $resident->birthplace     = 'San Manuel';
            $resident->gender         = $info['gender'];
            $resident->civil_status   = 'Single';
            $resident->address        = 'Zone ' . (($i % 7) + 1) . ', Barangay San Manuel';
            $resident->contact_number = '0917' . sprintf('%07d', 1000000 + $i);
            $resident->occupation     = 'IT Evaluator / Professor';
            $resident->is_voter       = true;
            $resident->voter_status   = 'verified';
            $resident->is_non_voter   = false;
            $resident->age            = 31;
            $resident->save();
        }

        // Final safeguard sweep: absolutely no official resident (RSM-%) has a user_id
        Resident::where('resident_code', 'like', 'RSM-%')->update(['user_id' => null]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Safe rollback
    }
};
