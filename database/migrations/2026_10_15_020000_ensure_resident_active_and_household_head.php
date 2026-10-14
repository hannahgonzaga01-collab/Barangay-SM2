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
        // 1. Ensure Hannah's user account and any approved resident accounts are active
        $users = User::where('email', 'like', '%hannahgonzaga01%')
            ->orWhere('voter_status', 'approved')
            ->get();

        foreach ($users as $user) {
            $user->status = 'active';
            $user->is_active = 1;
            $user->save();
        }

        // 2. Ensure official resident profile for Patricia Angela David / Hannah is marked as household head
        $resident = Resident::where('resident_code', 'RES-J72D88ZN')->first();
        if (!$resident) {
            $resident = Resident::where('first_name', 'Patricia Angela')
                ->where('last_name', 'David')
                ->first();
        }

        if ($resident) {
            $resident->is_household_head = true;
            $resident->verification_status = 'approved';
            $resident->save();

            // Link any unassigned family members that may have been created
            Resident::where('address', $resident->address)
                ->where('id', '!=', $resident->id)
                ->whereNull('household_head_id')
                ->where('is_household_head', false)
                ->update(['household_head_id' => $resident->id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
