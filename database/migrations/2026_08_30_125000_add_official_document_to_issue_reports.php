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
        Schema::table('issue_reports', function (Blueprint $table) {
            if (!Schema::hasColumn('issue_reports', 'official_document')) {
                $table->string('official_document')->nullable()->after('evidence');
            }
            if (!Schema::hasColumn('issue_reports', 'official_document_name')) {
                $table->string('official_document_name')->nullable()->after('official_document');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issue_reports', function (Blueprint $table) {
            if (Schema::hasColumn('issue_reports', 'official_document')) {
                $table->dropColumn('official_document');
            }
            if (Schema::hasColumn('issue_reports', 'official_document_name')) {
                $table->dropColumn('official_document_name');
            }
        });
    }
};