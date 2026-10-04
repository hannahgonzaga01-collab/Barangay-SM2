<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use App\Models\Resident;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Rename Shared Resident Accounts (RES-DUMMY-001 to RES-DUMMY-005)
        $dummyNames = [
            1 => ['first' => 'Juan', 'middle' => 'Dela Cruz', 'gender' => 'Male'],
            2 => ['first' => 'Maria', 'middle' => 'Santos', 'gender' => 'Female'],
            3 => ['first' => 'Jose', 'middle' => 'Reyes', 'gender' => 'Male'],
            4 => ['first' => 'Angelica', 'middle' => 'Garcia', 'gender' => 'Female'],
            5 => ['first' => 'Carlo', 'middle' => 'Ramos', 'gender' => 'Male'],
        ];

        for ($i = 1; $i <= 5; $i++) {
            $code  = sprintf("RES-DUMMY-%03d", $i);
            $email = $i === 1 ? 'resident_eval@brgysm.ph' : "resident_eval{$i}@brgysm.ph";
            $info  = $dummyNames[$i];

            User::where('resident_code', $code)
                ->orWhere('email', $email)
                ->update([
                    'name'        => "{$info['first']} Dummy",
                    'first_name'  => $info['first'],
                    'middle_name' => $info['middle'],
                    'last_name'   => 'Dummy',
                    'gender'      => $info['gender'],
                ]);

            Resident::where('resident_code', $code)
                ->update([
                    'first_name'  => $info['first'],
                    'middle_name' => $info['middle'],
                    'last_name'   => 'Dummy',
                    'gender'      => $info['gender'],
                ]);
        }

        // 2. Rename Evaluator Accounts (RES-EVAL-001 to RES-EVAL-010)
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
            $adminEmail = "admin{$i}@brgysm.ph";
            $info  = $evaluatorNames[$i];

            User::where('resident_code', $code)
                ->orWhere('email', $email)
                ->update([
                    'name'        => "{$info['first']} Dummy",
                    'first_name'  => $info['first'],
                    'middle_name' => $info['middle'],
                    'last_name'   => 'Dummy',
                    'gender'      => $info['gender'],
                ]);

            Resident::where('resident_code', $code)
                ->update([
                    'first_name'  => $info['first'],
                    'middle_name' => $info['middle'],
                    'last_name'   => 'Dummy',
                    'gender'      => $info['gender'],
                ]);

            User::where('email', $adminEmail)
                ->update([
                    'name'        => "Admin {$info['first']} Dummy",
                    'first_name'  => "Admin {$info['first']}",
                    'middle_name' => 'BRGY',
                    'last_name'   => 'Dummy',
                ]);
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
