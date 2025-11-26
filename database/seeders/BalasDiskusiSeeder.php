<?php

namespace Database\Seeders;

use App\Models\BalasDiskusi;
use App\Models\Diskusi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BalasDiskusiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diskusis = Diskusi::all();
        $pelajars = User::where('peran', 'pelajar')->get();

        $balasans = [
            'Menurut saya, cara terbaik adalah dengan praktek langsung.',
            'Saya setuju dengan pendapat Anda, ini sangat membantu.',
            'Coba lihat dokumentasi resmi untuk informasi lebih lengkap.',
            'Saya juga mengalami hal yang sama sebelumnya. Ini solusinya...',
            'Terima kasih telah berbagi pengalaman Anda!',
            'Ini adalah pertanyaan yang sangat bagus dan relevan.',
            'Saya akan mencoba tips ini. Terima kasih!',
            'Setuju banget dengan penjelasan ini!',
            'Ada cara lain yang lebih efisien, yaitu dengan...',
            'Bagus sekali penjelasannya, sangat bermanfaat!',
        ];

        // Create balasan for each diskusi
        foreach ($diskusis as $diskusi) {
            $jumlahBalasan = rand(2, 5);
            for ($i = 0; $i < $jumlahBalasan; $i++) {
                if ($pelajars->count() > 0) {
                    $pembuat = $pelajars->random();
                    BalasDiskusi::create([
                        'diskusi_id' => $diskusi->id,
                        'pembuat_id' => $pembuat->id,
                        'konten' => $balasans[array_rand($balasans)],
                    ]);
                }
            }
            // Update jumlah_balasan di diskusi
            $diskusi->update(['jumlah_balasan' => $jumlahBalasan]);
        }

        echo "Balasan Diskusi seeder completed successfully!\n";
    }
}
