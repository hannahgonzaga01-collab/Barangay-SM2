<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('issue_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('issue_type');
            $table->string('complainant_name');
            $table->string('complainant_age')->nullable();
            $table->string('complainant_gender')->nullable();
            $table->string('respondent_name')->nullable();
            $table->string('respondent_address')->nullable();
            $table->string('respondent_contact')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('incident_date')->nullable();
            $table->string('contact')->nullable();
            $table->string('witness_name')->nullable();
            $table->string('witness_contact')->nullable();
            $table->text('evidence')->nullable(); // JSON array of file paths
            $table->string('department')->default('Justice'); // VAWC / Peace & Order / Justice
            $table->string('status')->default('submitted'); // submitted, under_review, resolved, closed
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issue_reports');
    }
};
