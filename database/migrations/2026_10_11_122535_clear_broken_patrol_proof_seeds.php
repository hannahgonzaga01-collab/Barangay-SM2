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
        if (Schema::hasTable('patrol_schedules')) {
            // Remove broken legacy file references that do not exist on disk/DB
            \Illuminate\Support\Facades\DB::table('patrol_schedules')
                ->where('image_path', 'LIKE', '%IrzjHNkeAQQCtckWKE7vr7uTtDYsumH6C9jh8zR0%')
                ->update([
                    'image_path' => null,
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
