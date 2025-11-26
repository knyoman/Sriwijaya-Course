<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa user
        $users = User::limit(5)->get();

        if ($users->isEmpty()) {
            $this->command->info('Tidak ada user di database. Silakan buat user terlebih dahulu.');
            return;
        }

        $activityTypes = ['login', 'logout', 'create', 'update', 'delete', 'view'];
        $descriptions = [
            'login' => '{user} melakukan login',
            'logout' => '{user} melakukan logout',
            'create' => 'Membuat pengguna baru: {user}',
            'update' => 'Mengubah data pengguna: {user}',
            'delete' => 'Menghapus pengguna: {user}',
            'view' => 'Melihat profil: {user}',
        ];

        // Buat 100 dummy activity logs
        for ($i = 0; $i < 100; $i++) {
            $randomUser = $users->random();
            $randomActivityType = $activityTypes[array_rand($activityTypes)];
            $description = str_replace('{user}', $randomUser->nama, $descriptions[$randomActivityType]);

            ActivityLog::create([
                'user_id' => $randomUser->id,
                'activity_type' => $randomActivityType,
                'description' => $description,
                'action_model' => 'User',
                'model_id' => $randomUser->id,
                'ip_address' => $this->generateRandomIp(),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);
        }

        $this->command->info('ActivityLog seeder berhasil dijalankan! 100 dummy records telah dibuat.');
    }

    /**
     * Generate random IP address
     */
    private function generateRandomIp(): string
    {
        return rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255);
    }
}
