<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('doc_number')->unique();
            $table->foreignId('resident_id')->constrained();
            $table->enum('doc_type', [
                'barangay_clearance','indigency',
                'move_in','move_out',
                'business_permit','digital_id','other'
            ]);
            $table->string('purpose');
            $table->boolean('is_resident')->default(true);
            $table->decimal('fee', 8, 2)->default(0.00);
            $table->enum('status', ['Pending','Processing','Ready','Released'])->default('Pending');
            $table->string('qr_code_path')->nullable();
            $table->foreignId('issued_by')->nullable()->constrained('users');
            $table->timestamp('issued_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
