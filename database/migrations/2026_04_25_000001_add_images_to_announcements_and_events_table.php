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
        if (!Schema::hasColumn('announcements', 'images')) {
            Schema::table('announcements', function (Blueprint $table) {
                $table->json('images')->nullable()->after('image_path');
            });
        }

        if (!Schema::hasColumn('events', 'images')) {
            Schema::table('events', function (Blueprint $table) {
                $table->json('images')->nullable()->after('image_path');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('announcements', 'images')) {
            Schema::table('announcements', function (Blueprint $table) {
                $table->dropColumn('images');
            });
        }

        if (Schema::hasColumn('events', 'images')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('images');
            });
        }
    }
};
