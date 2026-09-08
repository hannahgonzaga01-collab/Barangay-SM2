<?php
use Illuminate\Support\Facades\DB;
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
    // Dinadagdag natin si 'peace' sa listahan ng pwedeng roles
// Lagyan natin ng \ sa harap ng DB para gumana agad
DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'office', 'justice', 'vawc', 'peace', 'resident') NOT NULL DEFAULT 'resident'");}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
