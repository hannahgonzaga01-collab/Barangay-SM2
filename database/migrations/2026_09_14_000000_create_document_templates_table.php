<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('document_templates')) {
            Schema::create('document_templates', function (Blueprint $table) {
                $table->id();
                $table->string('doc_key')->unique();
                $table->string('title')->nullable();
                $table->string('header_line1')->default('PROVINCE OF CAVITE');
                $table->string('header_line2')->default('CITY OF DASMARIÑAS');
                $table->string('header_line3')->default('BARANGAY SAN MIGUEL 2');
                $table->string('header_line4')->default('OFFICE OF THE SANGGUNIANG BARANGAY');
                $table->text('body_template')->nullable();
                $table->string('captain_name')->default('MARVIN M. BENIS');
                $table->string('captain_title')->default('PUNONG BARANGAY');
                $table->text('footer_note')->nullable();
                $table->string('custom_bg_path')->nullable();
                $table->string('custom_logo_path')->nullable();
                $table->boolean('show_header_logos')->default(true);
                $table->boolean('is_custom')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('document_templates');
    }
};
