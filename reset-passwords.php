<?php

/**
 * Script untuk Reset Password ke Bcrypt
 * 
 * Gunakan script ini jika Artisan tidak bisa diakses
 * Letakkan file ini di root project, akses via browser: http://localhost:8000/reset-passwords.php
 * 
 * PENTING: Hapus file ini setelah selesai untuk keamanan!
 */

// Load Laravel bootstrap
require __DIR__ . '/bootstrap/app.php';

use App\Models\User;
use Illuminate\Support\Facades\Hash;

try {
    // Get all users
    $users = User::all();

    if ($users->isEmpty()) {
        echo "❌ Tidak ada user dalam database\n";
        exit;
    }

    $defaultPassword = 'password123';
    $count = 0;

    foreach ($users as $user) {
        $user->kata_sandi = Hash::make($defaultPassword);
        $user->save();
        $count++;
        echo "✓ Reset password user: {$user->email}\n";
    }

    echo "\n";
    echo "✅ Berhasil! Total user diupdate: {$count}\n";
    echo "Password default: {$defaultPassword}\n";
    echo "\n";
    echo "⚠️  PENTING: Hapus file 'reset-passwords.php' dari server untuk keamanan!\n";
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
