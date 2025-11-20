<?php

/**
 * Direct Database Update Script untuk Reset Password
 * 
 * Akses via terminal: php fix-passwords.php
 */

// Load Composer autoload
require __DIR__ . '/vendor/autoload.php';

// Create application instance
$app = require __DIR__ . '/bootstrap/app.php';

// Get service container
$container = $app;

// Boot the application
$container->make(\Illuminate\Contracts\Http\Kernel::class);

use App\Models\User;
use Illuminate\Support\Facades\Hash;

try {
    echo "\n================================\n";
    echo "Reset Password to Bcrypt\n";
    echo "================================\n\n";

    // Get all users
    $users = User::all();

    if ($users->isEmpty()) {
        echo "❌ Tidak ada user dalam database\n";
        exit;
    }

    $defaultPassword = 'password123';
    $count = 0;

    foreach ($users as $user) {
        $oldPassword = $user->kata_sandi;
        $user->kata_sandi = Hash::make($defaultPassword);
        $user->save();
        $count++;
        echo "✓ Reset password user ID {$user->id}: {$user->email}\n";
    }

    echo "\n================================\n";
    echo "✅ BERHASIL!\n";
    echo "================================\n";
    echo "Total user diupdate: {$count}\n";
    echo "Password baru: {$defaultPassword}\n";
    echo "================================\n\n";
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n";
    echo $e->getTraceAsString() . "\n";
    exit(1);
}
