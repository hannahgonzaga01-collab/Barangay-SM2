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
        Schema::table('issue_reports', function (Blueprint $table) {
            $table->string('guest_first_name')->nullable()->after('user_id');
            $table->string('guest_last_name')->nullable()->after('guest_first_name');
            $table->string('guest_email')->nullable()->after('guest_last_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issue_reports', function (Blueprint $table) {
            $table->dropColumn(['guest_first_name', 'guest_last_name', 'guest_email']);
        });
    }
};
