<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->string('spouse_name')->nullable()->after('civil_status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('spouse_name')->nullable()->after('civil_status');
        });
    }

    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn('spouse_name');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('spouse_name');
        });
    }
};
