<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mediation_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->string('complainant_name');
            $table->string('respondent_name');
            $table->text('case_description');
            $table->enum('status', [
                'Pending','Scheduled','Settled','Unresolved','Escalated'
            ])->default('Pending');
            $table->date('hearing_date')->nullable();
            $table->text('resolution')->nullable();
            $table->foreignId('handled_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mediation_cases');
    }
};
