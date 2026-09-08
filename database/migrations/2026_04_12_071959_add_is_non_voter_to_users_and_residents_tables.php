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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_non_voter')->default(false)->after('is_voter');
        });
        Schema::table('residents', function (Blueprint $table) {
            $table->boolean('is_non_voter')->default(false)->after('is_voter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_non_voter');
        });
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn('is_non_voter');
        });
    }
};
