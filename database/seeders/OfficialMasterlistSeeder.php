<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OfficialMasterlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = base_path('database/data/official_masterlist.json');
        if (!file_exists($jsonPath)) {
            $this->command?->error("Masterlist JSON not found at: {$jsonPath}");
            return;
        }

        $data = json_decode(file_get_contents($jsonPath), true);
        if (!$data || empty($data['heads'])) {
            $this->command?->error("Invalid or empty masterlist JSON data.");
            return;
        }

        // 1. Identify protected resident IDs (e.g. personal test account hannahgonzaga01)
        $hannahUser = User::where('email', 'like', '%hannahgonzaga01%')->first();
        $protectedCodes = [];
        if ($hannahUser && $hannahUser->resident_code) {
            $protectedCodes[] = $hannahUser->resident_code;
        }

        // Clear existing residents except protected
        if (!empty($protectedCodes)) {
            Resident::whereNotIn('resident_code', $protectedCodes)->forceDelete();
        } else {
            Resident::truncate();
        }

        // 2. Insert Heads
        $headMapping = []; // temp_id => ['id' => ..., 'household_id' => ..., 'address' => ...]
        foreach ($data['heads'] as $head) {
            $tempId = $head['temp_id'];
            unset($head['temp_id']);

            $r = Resident::create($head);
            $headMapping[$tempId] = [
                'id'           => $r->id,
                'household_id' => $r->household_id,
                'address'      => $r->address,
            ];
        }

        // 3. Insert Partners
        foreach ($data['partners'] as $partner) {
            $headTempId = $partner['head_temp_id'] ?? null;
            unset($partner['head_temp_id']);

            if ($headTempId && isset($headMapping[$headTempId])) {
                $partner['household_head_id'] = $headMapping[$headTempId]['id'];
                $partner['household_id']      = $headMapping[$headTempId]['household_id'];
                $partner['address']           = $headMapping[$headTempId]['address'];
            }

            Resident::create($partner);
        }

        // 4. Insert Children
        foreach ($data['children'] as $child) {
            $headTempId = $child['head_temp_id'] ?? null;
            unset($child['head_temp_id']);

            if ($headTempId && isset($headMapping[$headTempId])) {
                $child['household_head_id'] = $headMapping[$headTempId]['id'];
                $child['household_id']      = $headMapping[$headTempId]['household_id'];
                $child['address']           = $headMapping[$headTempId]['address'];
            }

            Resident::create($child);
        }

        // 5. Ensure all official residents from the Excel masterlist are clean (user_id = null)
        // so real residents can register their own accounts themselves
        Resident::where('resident_code', 'like', 'RSM-%')
            ->update(['user_id' => null]);

        // 6. Create 5 Dedicated Dummy Resident Accounts for Evaluation/Testing
        $dummyNames = [
            1 => ['first' => 'Juan', 'middle' => 'Dela Cruz', 'gender' => 'Male'],
            2 => ['first' => 'Maria', 'middle' => 'Santos', 'gender' => 'Female'],
            3 => ['first' => 'Jose', 'middle' => 'Reyes', 'gender' => 'Male'],
            4 => ['first' => 'Angelica', 'middle' => 'Garcia', 'gender' => 'Female'],
            5 => ['first' => 'Carlo', 'middle' => 'Ramos', 'gender' => 'Male'],
        ];

        for ($i = 1; $i <= 5; $i++) {
            $email = $i === 1 ? 'resident_eval@brgysm.ph' : "resident_eval{$i}@brgysm.ph";
            $code  = sprintf("RES-DUMMY-%03d", $i);
            $info  = $dummyNames[$i] ?? ['first' => 'Juan', 'middle' => 'Dela Cruz', 'gender' => 'Male'];

            $user = User::firstOrNew(['email' => $email]);
            $user->name              = "{$info['first']} Dummy";
            $user->first_name        = $info['first'];
            $user->middle_name       = $info['middle'];
            $user->last_name         = "Dummy";
            $user->password          = 'Password123';
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

            $dummyResident = Resident::firstOrNew(['resident_code' => $code]);
            $dummyResident->user_id           = $user->id;
            $dummyResident->first_name        = $info['first'];
            $dummyResident->middle_name       = $info['middle'];
            $dummyResident->last_name         = "Dummy";
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
    }
}
