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
        Schema::table('emergency_sos_alerts', function (Blueprint $table) {
            if (!Schema::hasColumn('emergency_sos_alerts', 'emergency_type')) {
                $table->string('emergency_type')->nullable()->after('home_address');
            }
            if (!Schema::hasColumn('emergency_sos_alerts', 'message')) {
                $table->text('message')->nullable()->after('emergency_type');
            }
            if (!Schema::hasColumn('emergency_sos_alerts', 'dispatched_units')) {
                $table->string('dispatched_units')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergency_sos_alerts', function (Blueprint $table) {
            if (Schema::hasColumn('emergency_sos_alerts', 'dispatched_units')) {
                $table->dropColumn('dispatched_units');
            }
            if (Schema::hasColumn('emergency_sos_alerts', 'message')) {
                $table->dropColumn('message');
            }
            if (Schema::hasColumn('emergency_sos_alerts', 'emergency_type')) {
                $table->dropColumn('emergency_type');
            }
        });
    }
};
