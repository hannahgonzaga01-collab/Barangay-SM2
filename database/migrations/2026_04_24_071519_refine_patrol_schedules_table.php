<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('patrol_schedules', function (Blueprint $table) {
            $table->string('team_name')->after('title')->nullable(); // Team A or Team B
            $table->text('personnel_names')->after('team_name')->nullable();
            $table->dropColumn(['team_a_schedule', 'team_b_schedule']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patrol_schedules', function (Blueprint $table) {
            //
        });
    }
};
