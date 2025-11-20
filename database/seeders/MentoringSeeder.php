<?php

namespace Database\Seeders;

use App\Models\Mentoring;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengajars = User::where('peran', 'pengajar')->get();

        if ($pengajars->count() > 0) {
            // Create 5 sample mentoring sessions
            Mentoring::create([
                'pengajar_id' => $pengajars->first()->id,
                'tanggal' => Carbon::now()->addDay()->format('Y-m-d'),
                'jam' => '14:00',
                'status' => 'Belum',
                'zoom_link' => 'https://zoom.us/j/123456789',
            ]);

            Mentoring::create([
                'pengajar_id' => $pengajars->get(1)?->id ?? $pengajars->first()->id,
                'tanggal' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'jam' => '15:30',
                'status' => 'Sudah',
                'zoom_link' => 'https://zoom.us/j/987654321',
            ]);

            Mentoring::create([
                'pengajar_id' => $pengajars->get(2)?->id ?? $pengajars->first()->id,
                'tanggal' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'jam' => '10:00',
                'status' => 'Belum',
                'zoom_link' => 'https://zoom.us/j/555666777',
            ]);

            Mentoring::create([
                'pengajar_id' => $pengajars->first()->id,
                'tanggal' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'jam' => '16:00',
                'status' => 'Sudah',
                'zoom_link' => 'https://zoom.us/j/888999000',
            ]);

            Mentoring::create([
                'pengajar_id' => $pengajars->get(1)?->id ?? $pengajars->first()->id,
                'tanggal' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'jam' => '13:00',
                'status' => 'Belum',
                'zoom_link' => 'https://zoom.us/j/111222333',
            ]);

            echo "Mentoring seeder completed successfully!\n";
        }
    }
}
