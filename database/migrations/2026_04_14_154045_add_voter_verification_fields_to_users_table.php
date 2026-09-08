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
            $table->string('voter_id_photo')->nullable()->after('is_voter');
            $table->string('voter_status')->nullable()->after('voter_id_photo');
            $table->text('decline_reason')->nullable()->after('voter_status');
        });
        
        Schema::table('residents', function (Blueprint $table) {
            $table->string('voter_status')->nullable()->after('is_voter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['voter_id_photo', 'voter_status', 'decline_reason']);
        });
        
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn(['voter_status']);
        });
    }
};
