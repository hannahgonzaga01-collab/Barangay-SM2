<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('issue_reports', function (Blueprint $table) {
            if (!Schema::hasColumn('issue_reports', 'is_on_behalf')) {
                $table->boolean('is_on_behalf')->default(false)->after('complainant_address');
            }
            if (!Schema::hasColumn('issue_reports', 'victim_name')) {
                $table->string('victim_name')->nullable()->after('is_on_behalf');
            }
            if (!Schema::hasColumn('issue_reports', 'victim_age')) {
                $table->integer('victim_age')->nullable()->after('victim_name');
            }
            if (!Schema::hasColumn('issue_reports', 'victim_gender')) {
                $table->string('victim_gender')->nullable()->after('victim_age');
            }
            if (!Schema::hasColumn('issue_reports', 'victim_relationship')) {
                $table->string('victim_relationship')->nullable()->after('victim_gender');
            }
            if (!Schema::hasColumn('issue_reports', 'transfer_reason')) {
                $table->text('transfer_reason')->nullable()->after('transfer_count');
            }
        });
    }

    public function down(): void
    {
        Schema::table('issue_reports', function (Blueprint $table) {
            $table->dropColumn([
                'is_on_behalf',
                'victim_name',
                'victim_age',
                'victim_gender',
                'victim_relationship',
                'transfer_reason',
            ]);
        });
    }
};
