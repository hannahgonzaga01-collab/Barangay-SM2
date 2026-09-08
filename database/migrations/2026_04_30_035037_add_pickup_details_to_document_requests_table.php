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
        Schema::table('document_requests', function (Blueprint $table) {
            $table->date('pickup_date')->nullable()->after('status');
            $table->time('pickup_time')->nullable()->after('pickup_date');
            $table->string('personnel_in_charge')->nullable()->after('pickup_time');
            $table->string('alternate_personnel')->nullable()->after('personnel_in_charge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_requests', function (Blueprint $table) {
            $table->dropColumn(['pickup_date', 'pickup_time', 'personnel_in_charge', 'alternate_personnel']);
        });
    }
};
