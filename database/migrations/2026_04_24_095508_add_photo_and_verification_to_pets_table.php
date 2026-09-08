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
        Schema::table('pets', function (Blueprint $table) {
            $table->string('pet_photo')->nullable()->after('pet_name');
            $table->string('vaccine_proof')->nullable()->after('last_vaccine_date');
            $table->string('vaccination_status')->default('unvaccinated')->after('vaccine_proof'); // unvaccinated, pending, verified, rejected
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn(['pet_photo', 'vaccine_proof', 'vaccination_status']);
        });
    }
};
