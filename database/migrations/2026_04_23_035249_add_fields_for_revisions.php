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
        if (!Schema::hasColumn('pets', 'vaccine_proof_path')) {
            Schema::table('pets', function (Blueprint $table) {
                $table->string('vaccine_proof_path')->nullable()->after('vaccine_status');
            });
        }

        Schema::table('document_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('document_requests', 'claimant_type')) {
                $table->enum('claimant_type', ['self', 'authorized'])->default('self')->after('user_id');
            }
            if (!Schema::hasColumn('document_requests', 'authorization_letter_path')) {
                $table->string('authorization_letter_path')->nullable()->after('claimant_type');
            }
            if (!Schema::hasColumn('document_requests', 'authorized_id_path')) {
                $table->string('authorized_id_path')->nullable()->after('authorization_letter_path');
            }
            if (!Schema::hasColumn('document_requests', 'disapproval_reason')) {
                $table->text('disapproval_reason')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn('vaccine_proof_path');
        });

        Schema::table('document_requests', function (Blueprint $table) {
            $table->dropColumn(['claimant_type', 'authorization_letter_path', 'authorized_id_path', 'disapproval_reason']);
        });
    }
};
