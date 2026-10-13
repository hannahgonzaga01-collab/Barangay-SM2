<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Resident;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Delete specific duplicate resident with code RES-OWUCBKVH
        Resident::where('resident_code', 'RES-OWUCBKVH')->forceDelete();

        // 2. Also ensure if any duplicate Joann Manubis remains, keep only the earliest record
        $duplicates = Resident::where('first_name', 'like', '%Joann%')
            ->where('last_name', 'like', '%Manubis%')
            ->orderBy('id', 'asc')
            ->get();

        if ($duplicates->count() > 1) {
            $extras = $duplicates->slice(1);
            foreach ($extras as $extra) {
                $extra->forceDelete();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cleanup migration does not need reverse
    }
};
