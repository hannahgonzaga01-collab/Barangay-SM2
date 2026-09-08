<?php
// Autoload Laravel framework from public directory
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$newPassword = 'password123';
$hash = Hash::make($newPassword);

// Update all users with role 'resident'
$updatedCount = User::where('role', 'resident')->update([
    'password' => $hash
]);

$residents = User::where('role', 'resident')->get(['id', 'name', 'email', 'role']);

header('Content-Type: application/json');
echo json_encode([
    'status' => 'success',
    'message' => "Successfully updated {$updatedCount} resident accounts with password '{$newPassword}'!",
    'new_password' => $newPassword,
    'hash' => $hash,
    'affected_residents' => $residents
], JSON_PRETTY_PRINT);
