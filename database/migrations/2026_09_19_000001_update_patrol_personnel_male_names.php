<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('patrol_schedules')) {
            DB::table('patrol_schedules')
                ->where('team_name', 'Team A')
                ->where(function($query) {
                    $query->where('personnel_names', 'LIKE', '%kei%')
                          ->orWhere('personnel_names', 'LIKE', '%inday%')
                          ->orWhere('personnel_names', 'LIKE', '%kikay%');
                })
                ->update(['personnel_names' => 'Danilo Cruz, Ramon Santos, Ernesto Reyes']);

            DB::table('patrol_schedules')
                ->where('team_name', 'Team B')
                ->where(function($query) {
                    $query->where('personnel_names', 'LIKE', '%lily%')
                          ->orWhere('personnel_names', 'LIKE', '%lala%');
                })
                ->update(['personnel_names' => 'Eduardo Garcia, Rodrigo Ramos, Nestor Mendoza']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
