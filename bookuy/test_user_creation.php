<?php

// Test script to check user creation
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "=== Testing User Creation ===\n\n";

// Show current users
echo "Current users:\n";
$users = User::all(['id', 'username', 'email']);
foreach ($users as $user) {
    echo "  ID: {$user->id}, Username: {$user->username}, Email: {$user->email}\n";
}
echo "\nTotal users: " . User::count() . "\n\n";

// Try to create a new user
echo "Creating new user...\n";
try {
    $newUser = User::create([
        'username' => 'Test New User ' . time(),
        'email' => 'test' . time() . '@example.com',
        'password' => bcrypt('password'),
    ]);
    
    echo "✅ New user created successfully!\n";
    echo "  New user ID: {$newUser->id}\n";
    echo "  New user Username: {$newUser->username}\n";
    echo "  New user Email: {$newUser->email}\n";
} catch (\Exception $e) {
    echo "❌ Error creating user: " . $e->getMessage() . "\n";
}

echo "\nAfter creation:\n";
$usersAfter = User::all(['id', 'username', 'email']);
foreach ($usersAfter as $user) {
    echo "  ID: {$user->id}, Username: {$user->username}, Email: {$user->email}\n";
}
echo "\nTotal users: " . User::count() . "\n";
