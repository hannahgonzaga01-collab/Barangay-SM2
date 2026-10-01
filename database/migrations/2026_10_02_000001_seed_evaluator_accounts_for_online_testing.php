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
        for ($i = 1; $i <= 10; $i++) {
            // ── 1. Create / Update Resident User Account ──
            $residentCode = sprintf("RES-EVAL-%03d", $i);
            $residentEmail = "evaluator{$i}@brgysm.ph";

            $residentUser = User::updateOrCreate(
                ['email' => $residentEmail],
                [
                    'name'              => "Evaluator {$i} Resident",
                    'first_name'        => "Evaluator{$i}",
                    'middle_name'       => "IT",
                    'last_name'         => "Resident",
                    'password'          => Hash::make('Password123'),
                    'role'              => 'resident',
                    'status'            => 'active',
                    'is_active'         => true,
                    'resident_code'     => $residentCode,
                    'contact_number'    => '0917' . sprintf('%07d', 1000000 + $i),
                    'gender'            => ($i % 2 === 0 ? 'Female' : 'Male'),
                    'civil_status'      => 'Single',
                    'birthday'          => '1995-05-15',
                    'birthplace'        => 'San Manuel',
                    'address'           => 'Zone ' . (($i % 7) + 1) . ', Barangay San Manuel',
                    'occupation'        => 'IT Evaluator',
                    'is_voter'          => true,
                    'voter_status'      => 'verified',
                    'is_non_voter'      => false,
                    'security_question' => "What is your mother's maiden name?",
                    'security_answer'   => 'Santos',
                ]
            );

            // ── 2. Create / Update Linked Resident Profile Record ──
            Resident::updateOrCreate(
                ['resident_code' => $residentCode],
                [
                    'user_id'           => $residentUser->id,
                    'first_name'        => "Evaluator{$i}",
                    'middle_name'       => "IT",
                    'last_name'         => "Resident",
                    'birthday'          => '1995-05-15',
                    'birthplace'        => 'San Manuel',
                    'gender'            => ($i % 2 === 0 ? 'Female' : 'Male'),
                    'civil_status'      => 'Single',
                    'address'           => 'Zone ' . (($i % 7) + 1) . ', Barangay San Manuel',
                    'contact_number'    => '0917' . sprintf('%07d', 1000000 + $i),
                    'occupation'        => 'IT Evaluator / Professor',
                    'is_voter'          => true,
                    'voter_status'      => 'verified',
                    'is_non_voter'      => false,
                    'age'               => 31,
                ]
            );

            // ── 3. Create / Update Admin Account ──
            $adminEmail = "admin{$i}@brgysm.ph";

            User::updateOrCreate(
                ['email' => $adminEmail],
                [
                    'name'              => "Evaluator {$i} Admin",
                    'first_name'        => "Admin{$i}",
                    'middle_name'       => "BRGY",
                    'last_name'         => "Official",
                    'password'          => Hash::make('Password123'),
                    'role'              => 'admin',
                    'status'            => 'active',
                    'is_active'         => true,
                    'contact_number'    => '0918' . sprintf('%07d', 2000000 + $i),
                    'security_question' => 'What is the Barangay Station Code?',
                    'security_answer'   => 'BRGY-2026',
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $residentCode = sprintf("RES-EVAL-%03d", $i);
            $residentEmail = "evaluator{$i}@brgysm.ph";
            $adminEmail = "admin{$i}@brgysm.ph";

            Resident::where('resident_code', $residentCode)->forceDelete();
            User::whereIn('email', [$residentEmail, $adminEmail])->delete();
        }
    }
};
