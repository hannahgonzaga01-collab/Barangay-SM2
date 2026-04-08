<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('resident_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            // Personal Info
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->date('birthday');
            $table->string('birthplace');
            $table->enum('gender', ['Male', 'Female', 'Prefer not to say']);
            $table->enum('civil_status', ['Single','Married','Widowed','Separated','Divorced']);
            $table->string('occupation')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('photo')->nullable();
            // Status flags
            $table->boolean('is_voter')->default(false);
            $table->boolean('is_pwd')->default(false);
            $table->boolean('is_senior')->default(false);
            $table->boolean('is_single_parent')->default(false);
            $table->boolean('is_student')->default(false);
            // Memberships
            $table->json('memberships')->nullable();
            // Household
            $table->string('address');
            $table->boolean('is_household_head')->default(false);
            $table->foreignId('household_head_id')->nullable()->constrained('residents')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
