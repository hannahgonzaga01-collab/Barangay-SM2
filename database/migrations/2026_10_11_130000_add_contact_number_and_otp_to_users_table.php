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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'contact_number')) {
                $table->string('contact_number', 20)->nullable()->unique()->after('email');
            }
            if (!Schema::hasColumn('users', 'otp')) {
                $table->string('otp', 10)->nullable()->after('password');
            }
            if (!Schema::hasColumn('users', 'otp_expires_at')) {
                $table->timestamp('otp_expires_at')->nullable()->after('otp');
            }
        });

        // Ensure email is nullable for mobile-first residents
        try {
            Schema::table('users', function (Blueprint $table) {
                $table->string('email')->nullable()->change();
            });
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Could not alter email column to nullable: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'otp')) {
                $table->dropColumn(['otp', 'otp_expires_at']);
            }
        });
    }
};
