<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('digital_ids') && !Schema::hasColumn('digital_ids', 'contact_person_address')) {
            Schema::table('digital_ids', function (Blueprint $table) {
                $table->string('contact_person_address')->nullable()->after('contact_person_number');
            });
        }
    }

    public function down(): void {
        if (Schema::hasTable('digital_ids') && Schema::hasColumn('digital_ids', 'contact_person_address')) {
            Schema::table('digital_ids', function (Blueprint $table) {
                $table->dropColumn('contact_person_address');
            });
        }
    }
};
