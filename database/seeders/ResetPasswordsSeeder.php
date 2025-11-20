<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResetPasswordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeder ini untuk mereset semua password user ke format Bcrypt
     * Gunakan: php artisan db:seed --class=ResetPasswordsSeeder
     */
    public function run(): void
    {
        // Default password untuk semua user
        $defaultPassword = 'password123';

        // Reset semua password user
        User::all()->each(function ($user) use ($defaultPassword) {
            $user->update([
                'kata_sandi' => Hash::make($defaultPassword),
            ]);
        });

        $this->command->info('Semua password telah direset ke: ' . $defaultPassword);
        $this->command->info('Total user: ' . User::count());
    }
}
