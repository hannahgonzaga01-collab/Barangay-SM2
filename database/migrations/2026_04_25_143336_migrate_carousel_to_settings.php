<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Get existing carousel slides
        if (Schema::hasTable('carousel_slides')) {
            $slides = DB::table('carousel_slides')->get()->map(function ($slide) {
                return [
                    'image_path' => $slide->image_path,
                    'title'      => $slide->title,
                    'is_active'  => $slide->is_active,
                    'sort_order' => $slide->sort_order,
                ];
            });

            // 2. Save to site_settings
            DB::table('site_settings')->updateOrInsert(
                ['key' => 'carousel_data'],
                ['value' => json_encode($slides), 'updated_at' => now(), 'created_at' => now()]
            );

            // 3. Drop the table
            Schema::dropIfExists('carousel_slides');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('carousel_slides', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('title')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        $setting = DB::table('site_settings')->where('key', 'carousel_data')->first();
        if ($setting && $setting->value) {
            $slides = json_decode($setting->value, true);
            foreach ($slides as $slide) {
                DB::table('carousel_slides')->insert(array_merge($slide, ['created_at' => now(), 'updated_at' => now()]));
            }
            DB::table('site_settings')->where('key', 'carousel_data')->delete();
        }
    }
};
