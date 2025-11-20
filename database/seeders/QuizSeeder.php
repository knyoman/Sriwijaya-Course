<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\SoalQuiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Quiz for Course 1 (Belajar HTML)
        $quiz = Quiz::updateOrCreate(
            ['kursus_id' => 1, 'nama_quiz' => 'Web Development Basics'],
            [
                'deskripsi' => 'Quiz untuk menguji pemahaman Anda tentang dasar-dasar web development',
                'jumlah_soal' => 5,
                'durasi_menit' => 30,
                'urutan' => 1,
            ]
        );

        // Delete existing questions for this quiz
        $quiz->soal()->delete();

        // Create quiz questions
        $soal_data = [
            [
                'pertanyaan' => 'Apa singkatan dari HTML?',
                'pilihan_a' => 'HyperText Markup Language',
                'pilihan_b' => 'High Tech Markup Language',
                'pilihan_c' => 'Home Tool Markup Language',
                'pilihan_d' => 'Hyperlinks and Text Markup Language',
                'jawaban_benar' => 'A',
                'urutan' => 1,
            ],
            [
                'pertanyaan' => 'Tag HTML mana yang digunakan untuk membuat paragraph?',
                'pilihan_a' => '<p>',
                'pilihan_b' => '<paragraph>',
                'pilihan_c' => '<para>',
                'pilihan_d' => '<pg>',
                'jawaban_benar' => 'A',
                'urutan' => 2,
            ],
            [
                'pertanyaan' => 'Apa fungsi utama CSS?',
                'pilihan_a' => 'Untuk membuat struktur halaman',
                'pilihan_b' => 'Untuk styling dan tampilan halaman',
                'pilihan_c' => 'Untuk membuat database',
                'pilihan_d' => 'Untuk membuat server',
                'jawaban_benar' => 'B',
                'urutan' => 3,
            ],
            [
                'pertanyaan' => 'Tag HTML manakah yang digunakan untuk membuat heading terbesar?',
                'pilihan_a' => '<h6>',
                'pilihan_b' => '<h3>',
                'pilihan_c' => '<h1>',
                'pilihan_d' => '<header>',
                'jawaban_benar' => 'C',
                'urutan' => 4,
            ],
            [
                'pertanyaan' => 'Apa tujuan utama dari JavaScript dalam web development?',
                'pilihan_a' => 'Untuk styling halaman',
                'pilihan_b' => 'Untuk membuat interaktivitas di halaman web',
                'pilihan_c' => 'Untuk membuat database',
                'pilihan_d' => 'Untuk hosting website',
                'jawaban_benar' => 'B',
                'urutan' => 5,
            ],
        ];

        foreach ($soal_data as $soal) {
            $soal['quiz_id'] = $quiz->id;
            SoalQuiz::create($soal);
        }
    }
}
