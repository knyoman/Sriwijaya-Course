<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample materials for course 1 (Web Development Basics)
        $materiData = [
            [
                'kursus_id' => 1,
                'judul_materi' => 'Pengenalan HTML',
                'deskripsi' => 'Pelajari dasar-dasar HTML dan struktur dokumen web',
                'urutan' => 1,
                'tipe_konten' => 'video',
                'url_konten' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'durasi_menit' => 15,
            ],
            [
                'kursus_id' => 1,
                'judul_materi' => 'Tag dan Elemen HTML',
                'deskripsi' => 'Memahami berbagai tag HTML dan cara penggunaannya',
                'urutan' => 2,
                'tipe_konten' => 'video',
                'url_konten' => 'https://www.youtube.com/watch?v=jNQXAC9IVRw',
                'durasi_menit' => 20,
            ],
            [
                'kursus_id' => 1,
                'judul_materi' => 'Pengenalan CSS',
                'deskripsi' => 'Belajar styling dengan CSS untuk membuat website yang menarik',
                'urutan' => 3,
                'tipe_konten' => 'video',
                'url_konten' => 'https://www.youtube.com/watch?v=9bZkp7q19f0',
                'durasi_menit' => 25,
            ],
            [
                'kursus_id' => 1,
                'judul_materi' => 'Styling & Layout',
                'deskripsi' => 'Menguasai layout CSS dan teknik styling lanjutan',
                'urutan' => 4,
                'tipe_konten' => 'video',
                'url_konten' => 'https://www.youtube.com/watch?v=ZYV6dYtz4HA',
                'durasi_menit' => 30,
            ],
            [
                'kursus_id' => 1,
                'judul_materi' => 'Responsive Design',
                'deskripsi' => 'Buat website yang responsif untuk berbagai ukuran layar',
                'urutan' => 5,
                'tipe_konten' => 'video',
                'url_konten' => 'https://www.youtube.com/watch?v=JlrB7KIGlE0',
                'durasi_menit' => 28,
            ],
            [
                'kursus_id' => 1,
                'judul_materi' => 'JavaScript Dasar',
                'deskripsi' => 'Pengenalan JavaScript dan konsep dasar programming',
                'urutan' => 6,
                'tipe_konten' => 'video',
                'url_konten' => 'https://www.youtube.com/watch?v=_uQrJ0TkSuc',
                'durasi_menit' => 35,
            ],
            [
                'kursus_id' => 1,
                'judul_materi' => 'DOM Manipulation',
                'deskripsi' => 'Manipulasi DOM dengan JavaScript untuk interaktivitas',
                'urutan' => 7,
                'tipe_konten' => 'video',
                'url_konten' => 'https://www.youtube.com/watch?v=eaVgIJA1OLQ',
                'durasi_menit' => 32,
            ],
        ];

        foreach ($materiData as $materi) {
            Materi::updateOrCreate(
                ['kursus_id' => $materi['kursus_id'], 'urutan' => $materi['urutan']],
                $materi
            );
        }
    }
}
