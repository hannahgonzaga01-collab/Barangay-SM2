<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'image_path')) {
                $table->string('image_path')->nullable()->after('images');
            }
            if (!Schema::hasColumn('projects', 'completion_date')) {
                $table->date('completion_date')->nullable()->after('end_date');
            }
            if (!Schema::hasColumn('projects', 'budget')) {
                $table->decimal('budget', 15, 2)->nullable()->after('status');
            }
            if (!Schema::hasColumn('projects', 'contractor_lead')) {
                $table->string('contractor_lead')->nullable()->after('budget');
            }
            if (!Schema::hasColumn('projects', 'is_archived')) {
                $table->boolean('is_archived')->default(false)->after('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $cols = ['image_path', 'completion_date', 'budget', 'contractor_lead', 'is_archived'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('projects', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
