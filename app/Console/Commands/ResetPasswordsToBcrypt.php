<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetPasswordsToBcrypt extends Command
{
    protected $signature = 'passwords:reset-to-bcrypt {--password=password123 : Default password untuk semua user}';

    protected $description = 'Reset semua password user ke format Bcrypt';

    public function handle()
    {
        $password = $this->option('password');

        if ($this->confirm('Anda akan mereset semua password user ke: ' . $password . '. Lanjutkan?')) {
            User::all()->each(function ($user) use ($password) {
                $user->update([
                    'kata_sandi' => Hash::make($password),
                ]);
            });

            $this->info('✓ Semua password telah direset ke: ' . $password);
            $this->info('✓ Total user diupdate: ' . User::count());
        } else {
            $this->info('Operasi dibatalkan.');
        }
    }
}
