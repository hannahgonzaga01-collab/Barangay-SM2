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
        if (Schema::hasTable('residents') && !Schema::hasColumn('residents', 'is_third_gen')) {
            Schema::table('residents', function (Blueprint $table) {
                $table->boolean('is_third_gen')->default(false)->after('is_bedridden');
            });
        }

        if (Schema::hasTable('users') && !Schema::hasColumn('users', 'is_third_gen')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_third_gen')->default(false)->after('is_bedridden');
            });
        }

        if (Schema::hasTable('document_requests') && !Schema::hasColumn('document_requests', 'released_at')) {
            Schema::table('document_requests', function (Blueprint $table) {
                $table->timestamp('released_at')->nullable()->after('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('residents') && Schema::hasColumn('residents', 'is_third_gen')) {
            Schema::table('residents', function (Blueprint $table) {
                $table->dropColumn('is_third_gen');
            });
        }

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'is_third_gen')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_third_gen');
            });
        }

        if (Schema::hasTable('document_requests') && Schema::hasColumn('document_requests', 'released_at')) {
            Schema::table('document_requests', function (Blueprint $table) {
                $table->dropColumn('released_at');
            });
        }
    }
};
