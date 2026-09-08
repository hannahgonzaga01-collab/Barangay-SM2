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
        Schema::create('patrol_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('MONTHLY PATROLS SCHED');
            $table->string('schedule_date')->nullable();
            $table->string('image_path')->nullable();
            $table->text('team_a_schedule')->nullable();
            $table->text('team_b_schedule')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patrol_schedules');
    }
};
