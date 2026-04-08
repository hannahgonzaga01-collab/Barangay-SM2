<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vawc_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->string('victim_name');
            $table->string('suspect_name');
            $table->text('case_description');
            $table->enum('case_type', [
                'Physical Abuse','Emotional Abuse',
                'Sexual Abuse','Economic Abuse'
            ]);
            $table->enum('status', [
                'Reported','Under Assessment','For Referral','Closed'
            ])->default('Reported');
            $table->boolean('protection_order_filed')->default(false);
            $table->text('counseling_notes')->nullable();
            $table->string('police_referral')->nullable();
            $table->foreignId('handled_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vawc_cases');
    }
};
