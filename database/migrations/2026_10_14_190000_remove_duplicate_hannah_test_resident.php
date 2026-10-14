<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Resident;
use App\Models\User;
use App\Models\DigitalId;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Find the official resident with photo (Patricia Angela David, RES-J72D88ZN)
        $officialResident = Resident::where('resident_code', 'RES-J72D88ZN')->first();
        if (!$officialResident) {
            $officialResident = Resident::where('first_name', 'Patricia Angela')
                ->where('last_name', 'David')
                ->whereNotNull('photo')
                ->first();
        }

        // 2. Find any duplicate resident without photo (specifically RES-TEST-HANNAH or ghost duplicate)
        $duplicates = Resident::where('resident_code', 'RES-TEST-HANNAH')
            ->orWhere(function ($q) {
                $q->where('first_name', 'Patricia Angela')
                  ->where('last_name', 'David')
                  ->whereNull('photo');
            })
            ->get();

        foreach ($duplicates as $dup) {
            // Never delete the official resident
            if ($officialResident && $dup->id === $officialResident->id) {
                continue;
            }

            $dup->delete();
        }

        // 3. Ensure User (hannahgonzaga01@gmail.com) is correctly linked to the official resident with photo
        $user = User::where('email', 'like', '%hannahgonzaga01%')->first();
        if ($user && $officialResident) {
            $user->resident_code = $officialResident->resident_code;
            if ($officialResident->photo && empty($user->photo)) {
                $user->photo = $officialResident->photo;
            }
            $user->save();

            $officialResident->user_id = $user->id;
            $officialResident->save();

            // Also make sure any existing Digital ID points to user
            $digitalId = DigitalId::where('user_id', $user->id)->first();
            if ($digitalId && $digitalId->status === 'generated') {
                if (empty($digitalId->id_number)) {
                    $digitalId->id_number = 'BSM2-' . date('y-m') . '-' . str_pad($digitalId->id, 3, '0', STR_PAD_LEFT);
                    $digitalId->save();
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nothing to revert
    }
};
