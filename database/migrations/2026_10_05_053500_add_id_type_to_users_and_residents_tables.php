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
        if (!Schema::hasColumn('users', 'id_type')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('id_type')->nullable()->after('voter_id_photo');
            });
        }

        if (!Schema::hasColumn('residents', 'id_type')) {
            Schema::table('residents', function (Blueprint $table) {
                $table->string('id_type')->nullable()->after('voter_id_photo');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'id_type')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('id_type');
            });
        }

        if (Schema::hasColumn('residents', 'id_type')) {
            Schema::table('residents', function (Blueprint $table) {
                $table->dropColumn('id_type');
            });
        }
    }
};
