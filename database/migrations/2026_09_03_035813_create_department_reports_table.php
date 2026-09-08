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
        Schema::create('department_reports', function (Blueprint $table) {
            $table->id();
            $table->string('department'); // VAWC, Peace & Order, Justice, Office
            $table->string('report_title');
            $table->string('reporting_period');
            $table->json('report_data')->nullable();
            $table->string('template_file')->nullable();
            $table->string('submitted_by');
            $table->string('submitted_role')->nullable();
            $table->string('status')->default('Submitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_reports');
    }
};
