<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vawc_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('staff_name')->default('System Officer');
            $table->string('staff_role')->nullable()->default('VAWC Officer');
            $table->string('action'); // case_view, case_transfer, pnp_escalation, export_pdf, export_csv, summary_update, incident_created, referral_edit
            $table->unsignedBigInteger('case_id')->nullable();
            $table->string('case_code')->nullable();
            $table->text('details')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vawc_audit_logs');
    }
};
