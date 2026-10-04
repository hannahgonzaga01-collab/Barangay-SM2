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

        // 5. Ensure the 5 Pre-verified Shared Accounts are linked to Head #1 to #5
        $sharedEmails = [
            1 => 'resident_eval@brgysm.ph',
            2 => 'resident_eval2@brgysm.ph',
            3 => 'resident_eval3@brgysm.ph',
            4 => 'resident_eval4@brgysm.ph',
            5 => 'resident_eval5@brgysm.ph',
        ];

        $firstHeads = Resident::where('is_household_head', true)->take(5)->get();
        foreach ($firstHeads as $idx => $head) {
            $email = $sharedEmails[$idx + 1] ?? null;
            if (!$email) continue;

            $user = User::firstOrNew(['email' => $email]);
            $user->name              = trim($head->first_name . ' ' . $head->last_name);
            $user->first_name        = $head->first_name;
            $user->middle_name       = $head->middle_name;
            $user->last_name         = $head->last_name;
            $user->password          = 'Password123';
            $user->role              = 'resident';
            $user->status            = 'active';
            $user->is_active         = true;
            $user->resident_code     = $head->resident_code;
            $user->contact_number    = $head->contact_number ?: ('0917' . sprintf('%07d', 4000000 + $idx + 1));
            $user->gender            = $head->gender;
            $user->civil_status      = $head->civil_status;
            $user->birthday          = $head->birthday;
            $user->birthplace        = $head->birthplace;
            $user->address           = $head->address;
            $user->occupation        = $head->occupation ?: 'Employed';
            $user->is_voter          = true;
            $user->voter_status      = 'verified';
            $user->is_non_voter      = false;
            $user->security_question = "What is your mother's maiden name?";
            $user->security_answer   = 'Santos';
            $user->save();

            $head->update([
                'user_id'      => $user->id,
                'is_voter'     => true,
                'voter_status' => 'verified',
                'is_non_voter' => false,
            ]);
        }
    }
}
