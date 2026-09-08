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
            $table->string('claimant_first_name')->nullable()->after('claimant_relation');
            $table->string('claimant_middle_name')->nullable()->after('claimant_first_name');
            $table->string('claimant_last_name')->nullable()->after('claimant_middle_name');
        });
    }

    public function down(): void
    {
        Schema::table('document_requests', function (Blueprint $table) {
            $table->dropColumn(['claimant_first_name', 'claimant_middle_name', 'claimant_last_name']);
        });
    }
};
