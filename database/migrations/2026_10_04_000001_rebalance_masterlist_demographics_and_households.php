<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \App\Services\DemographicRebalancer::forceRebalance();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Safe rollback
    }
};
