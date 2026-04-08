<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ADMIN
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@brgysm2.com',
            'password' => bcrypt('Admin123!'),
            'role' => 'admin',
             'status' => 'active',
            'security_question' => 'What is your first pet\'s name?',
            'security_answer' => 'Goldie',
        ]);

        // 2. OFFICE STAFF
        User::create([
            'name' => 'Office Staff',
            'email' => 'office@brgysm2.com',
            'password' =>bcrypt('Office123!'),
            'role' => 'office',
             'status' => 'active',
            'security_question' => 'What is the Barangay Station Code?',
            'security_answer' => 'BRGY-2026',
        ]);

        // 3. VAWC STAFF
        User::create([
            'name' => 'VAWC Staff',
            'email' => 'vawc@brgysm2.com',
            'password' => bcrypt('Vawc123!'),
            'role' => 'vawc',
             'status' => 'active',
            'security_question' => 'What is the Barangay Station Code?',
            'security_answer' => 'BRGY-2026',
        ]);

        // 4. JUSTICE STAFF
        User::create([
            'name' => 'Justice Staff',
            'email' => 'justice@brgysm2.com',
            'password' => bcrypt('Justice123!'),
            'role' => 'justice',
             'status' => 'active',
            'security_question' => 'What is the Barangay Station Code?',
            'security_answer' => 'BRGY-2026',
        ]);

       // 5. PEACE AND ORDER
        User::create([
            'name' => 'Peace and Order',
            'email' => 'peace@brgysm2.com',
            'password' => bcrypt('Peace123!'),
            'role' => 'peace',
            'status' => 'active', // DAGDAG ITO
            'security_question' => 'What is the Barangay Station Code?',
            'security_answer' => 'BRGY-2026',
        ]);

        // 6. RESIDENT
        User::create([
            'name' => 'Juan Dela Cruz',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('Resident123!'),
            'role' => 'resident',
            'status' => 'active',
            'security_question' => "What is your mother's maiden name?",
            'security_answer' => 'Santos',
        ]);
    }
}
