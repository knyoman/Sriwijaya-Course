<?php

namespace Database\Seeders;

use App\Models\Diskusi;
use App\Models\Kursus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiskusiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kursusList = Kursus::all();
        $pelajars = User::where('peran', 'pelajar')->get();

        $topiks = [
            'Apa itu HTML dan fungsinya?',
            'Bagaimana cara membuat form di HTML?',
            'Perbedaan antara CSS Grid dan Flexbox',
            'Tutorial membuat website responsive',
            'Best practice JavaScript untuk pemula',
            'Bagaimana mengatasi error di console?',
            'Tips belajar coding lebih efektif',
            'Rekomendasi tools untuk developer web',
        ];

        $contents = [
            'Saya ingin belajar lebih dalam tentang topik ini. Adakah yang bisa membantu menjelaskan?',
            'Saya mengalami kesulitan dengan materi ini. Bisa diberikan contoh yang lebih sederhana?',
            'Apakah ada cara alternatif untuk menyelesaikan masalah ini?',
            'Saya sudah mencoba tetapi hasilnya tidak sesuai. Ada yang tahu solusinya?',
            'Ini sangat berguna! Terima kasih sudah berbagi tips ini.',
            'Adakah resource tambahan yang direkomendasikan untuk topik ini?',
            'Saya berhasil menerapkan ini di project saya. Sangat membantu!',
            'Bagaimana dengan kasus yang lebih kompleks?',
        ];

        // Create diskusi for each kursus
        foreach ($kursusList as $kursus) {
            for ($i = 0; $i < rand(3, 5); $i++) {
                if ($pelajars->count() > 0) {
                    $pembuat = $pelajars->random();
                    Diskusi::create([
                        'kursus_id' => $kursus->id,
                        'judul' => $topiks[array_rand($topiks)],
                        'konten' => $contents[array_rand($contents)],
                        'pembuat_id' => $pembuat->id,
                        'jumlah_balasan' => 0,
                    ]);
                }
            }
        }

        echo "Diskusi seeder completed successfully!\n";
    }
}
