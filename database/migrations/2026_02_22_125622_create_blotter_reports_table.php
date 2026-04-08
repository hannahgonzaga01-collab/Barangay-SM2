<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blotter_reports', function (Blueprint $table) {
            $table->id();
            $table->string('blotter_number')->unique();
            $table->string('complainant_name');
            $table->string('respondent_name');
            $table->enum('incident_type', [
                'Noise Complaint','Minor Accident','Theft',
                'Dispute','Trespassing','Stray Animal','Other'
            ]);
            $table->text('incident_details');
            $table->string('incident_location');
            $table->dateTime('incident_datetime');
            $table->enum('status', ['Open','Under Investigation','Resolved','Closed'])->default('Open');
            $table->text('remarks')->nullable();
            $table->foreignId('recorded_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blotter_reports');
    }
};
