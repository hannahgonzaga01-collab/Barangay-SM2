<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

       public function run(): void
{
    // 1. Office Staff Account
    \App\Models\User::create([
        'name' => 'Office Staff',
        'email' => 'office@brgysm2.com',
        'password' => Hash::make('Office123!'),
        'role' => 'office',
        'is_active' => true,
    ]);

    // 2. Justice Officer Account
    \App\Models\User::create([
        'name' => 'Justice Officer',
        'email' => 'justice@brgysm2.com',
        'password' => Hash::make('Justice123!'),
        'role' => 'justice',
        'is_active' => true,
    ]);

    // 3. VAWC Officer Account
    \App\Models\User::create([
        'name' => 'VAWC Staff',
        'email' => 'vawc@brgysm2.com',
        'password' => Hash::make('Vawc123!'),
        'role' => 'vawc',
        'is_active' => true,
    ]);

    // 4. PEACE Officer Account
    \App\Models\User::create([
        'name' => 'Peace and Order',
        'email' => 'peace@brgysm2.com',
        'password' => Hash::make('Peace123!'),
        'role' => 'peace',
        'is_active' => true,
    ]);

    // 5. Resident Account
    \App\Models\User::create([
        'name' => 'Juan Dela Cruz',
        'email' => 'juan@brgysm2.com',
        'password' => Hash::make('Resident123!'),
        'role' => 'resident',
        'is_active' => true,
    ]);

     // 6. Admin Account
    \App\Models\User::create([
        'name' => 'Admin User',
        'email' => 'admin@brgysm2.com',
        'password' => Hash::make('Admin123!'),
        'role' => 'admin',
        'is_active' => true,
    ]);

}
}
