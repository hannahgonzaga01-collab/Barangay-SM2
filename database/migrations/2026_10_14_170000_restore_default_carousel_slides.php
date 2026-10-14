<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $defaultSlides = [
            [
                'id'         => 1001,
                'image_path' => 'images/womens.jpg',
                'title'      => "Celebrating Women's Month",
                'is_active'  => true,
                'sort_order' => 0,
            ],
            [
                'id'         => 1002,
                'image_path' => 'images/canal.jpg',
                'title'      => 'Operational Linis Canal',
                'is_active'  => true,
                'sort_order' => 1,
            ],
            [
                'id'         => 1003,
                'image_path' => 'images/cleanup.jpg',
                'title'      => 'Manila Bay Weekly Clean Up Drive',
                'is_active'  => true,
                'sort_order' => 2,
            ],
        ];

        DB::table('site_settings')->updateOrInsert(
            ['key' => 'carousel_data'],
            [
                'value'      => json_encode($defaultSlides),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        Cache::forget('resident_portal_public_data');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse required
    }
};
