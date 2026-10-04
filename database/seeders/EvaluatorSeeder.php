<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Resident;

class EvaluatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            $info = $evaluatorNames[$i] ?? ['first' => 'Paolo', 'middle' => 'Bautista', 'gender' => 'Male'];

            // ── 1. Create / Update Resident User Account ──
            $residentCode = sprintf("RES-EVAL-%03d", $i);
            $residentEmail = "evaluator{$i}@brgysm.ph";

            $residentUser = User::updateOrCreate(
                ['email' => $residentEmail],
                [
                    'name'              => "{$info['first']} Dummy",
                    'first_name'        => $info['first'],
                    'middle_name'       => $info['middle'],
                    'last_name'         => "Dummy",
                    'password'          => Hash::make('Password123'),
                    'role'              => 'resident',
                    'status'            => 'active',
                    'is_active'         => true,
                    'resident_code'     => $residentCode,
                    'contact_number'    => '0917' . sprintf('%07d', 1000000 + $i),
                    'gender'            => $info['gender'],
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
                    'first_name'        => $info['first'],
                    'middle_name'       => $info['middle'],
                    'last_name'         => "Dummy",
                    'birthday'          => '1995-05-15',
                    'birthplace'        => 'San Manuel',
                    'gender'            => $info['gender'],
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
                    'name'              => "Admin {$info['first']} Dummy",
                    'first_name'        => "Admin {$info['first']}",
                    'middle_name'       => "BRGY",
                    'last_name'         => "Dummy",
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
}
