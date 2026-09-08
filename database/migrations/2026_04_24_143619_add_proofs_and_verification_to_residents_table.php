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
        Schema::table('residents', function (Blueprint $table) {
            $table->string('senior_proof')->nullable();
            $table->string('pwd_proof')->nullable();
            $table->string('bedridden_proof')->nullable();
            $table->string('verification_status')->default('approved'); // approved, pending, rejected
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn(['senior_proof', 'pwd_proof', 'bedridden_proof', 'verification_status']);
        });
    }
};
