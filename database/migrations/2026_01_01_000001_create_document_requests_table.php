<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // nullable for guests
            $table->string('guest_first_name')->nullable(); // for walk-in / unregistered
            $table->string('guest_last_name')->nullable();
            $table->string('document_type');
            $table->string('purpose')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('blk')->nullable();
            $table->string('lot')->nullable();
            $table->string('move_date')->nullable();
            $table->string('landlord')->nullable();
            $table->text('family_members')->nullable();
            $table->string('ward_name')->nullable();
            $table->string('ward_age')->nullable();
            $table->string('ward_relation')->nullable();
            $table->string('partner_name')->nullable();
            $table->string('living_since')->nullable();
            $table->string('claimant_name')->nullable();
            $table->string('claimant_relation')->nullable();
            $table->string('birth_month')->nullable();
            $table->string('birth_year')->nullable();
            $table->string('child_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('birth_attendant')->nullable();
            $table->string('born_from')->nullable();
            $table->string('residing_since')->nullable();
            $table->string('company_name')->nullable();
            $table->string('nature_of_business')->nullable();
            $table->string('non_op_since')->nullable();
            $table->string('status')->default('pending'); // pending, processing, ready, released
            $table->text('admin_notes')->nullable();
            $table->timestamp('notified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_requests');
    }
};
