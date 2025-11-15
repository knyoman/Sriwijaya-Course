<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kursus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat test user untuk setiap role
        $pelajar = User::create([
            'username' => 'pelajar1',
            'nama' => 'Ahmad Pelajar',
            'email' => 'pelajar@example.com',
            'kata_sandi' => Hash::make('password123'),
            'peran' => 'pelajar',
            'alamat' => 'Jalan Pendidikan No. 1',
        ]);

        $pengajar = User::create([
            'username' => 'pengajar1',
            'nama' => 'Ibu Pengajar',
            'email' => 'pengajar@example.com',
            'kata_sandi' => Hash::make('password123'),
            'peran' => 'pengajar',
            'alamat' => 'Jalan Guru No. 2',
        ]);

        $admin = User::create([
            'username' => 'admin1',
            'nama' => 'Administrator',
            'email' => 'admin@example.com',
            'kata_sandi' => Hash::make('password123'),
            'peran' => 'admin',
            'alamat' => 'Jalan Administrasi No. 3',
        ]);

        // Buat user tambahan dengan factory
        User::factory(5)->pelajar()->create();
        $pengajars = User::factory(2)->pengajar()->create();
        User::factory(1)->admin()->create();

        // Buat kursus-kursus dengan berbagai pengajar
        $pengajarIds = User::where('peran', 'pengajar')->pluck('id')->toArray();

        $courses = [
            [
                'nama' => 'Web Development Basics',
                'slug' => 'web-development-basics',
                'deskripsi' => 'Belajar dasar-dasar pemrograman web dengan HTML, CSS, dan JavaScript',
                'harga' => 299000,
                'image' => 'https://images.unsplash.com/photo-1633356122544-f134324ef6db?w=400&h=300&fit=crop',
                'pengajar_id' => $pengajarIds[0] ?? $pengajar->id,
                'status' => 'published',
                'durasi_jam' => 20,
                'konten' => 'Konten lengkap untuk web development basics',
            ],
            [
                'nama' => 'PHP Advanced',
                'slug' => 'php-advanced',
                'deskripsi' => 'Kuasai PHP tingkat lanjut untuk membangun aplikasi web yang robust',
                'harga' => 349000,
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400&h=300&fit=crop',
                'pengajar_id' => $pengajarIds[1] ?? $pengajar->id,
                'status' => 'published',
                'durasi_jam' => 25,
                'konten' => 'Materi PHP tingkat lanjut',
            ],
            [
                'nama' => 'React JS Mastery',
                'slug' => 'react-js-mastery',
                'deskripsi' => 'Pelajari React JS untuk membuat aplikasi modern dan interaktif',
                'harga' => 399000,
                'image' => 'https://images.unsplash.com/photo-1625948515291-69613efd103f?w=400&h=300&fit=crop',
                'pengajar_id' => $pengajarIds[0] ?? $pengajar->id,
                'status' => 'published',
                'durasi_jam' => 30,
                'konten' => 'Panduan lengkap React JS',
            ],
            [
                'nama' => 'Python untuk Data Science',
                'slug' => 'python-data-science',
                'deskripsi' => 'Kuasai Python untuk analisis data dan machine learning',
                'harga' => 449000,
                'image' => 'https://images.unsplash.com/photo-1526374965328-7f5ae4e8a96f?w=400&h=300&fit=crop',
                'pengajar_id' => $pengajarIds[1] ?? $pengajar->id,
                'status' => 'published',
                'durasi_jam' => 35,
                'konten' => 'Kursus data science dengan Python',
            ],
            [
                'nama' => 'Laravel Framework Complete',
                'slug' => 'laravel-complete',
                'deskripsi' => 'Bangun aplikasi web professional dengan Laravel framework',
                'harga' => 379000,
                'image' => 'https://images.unsplash.com/photo-1517694712555-2d95d987a643?w=400&h=300&fit=crop',
                'pengajar_id' => $pengajarIds[0] ?? $pengajar->id,
                'status' => 'published',
                'durasi_jam' => 28,
                'konten' => 'Framework Laravel lengkap',
            ],
            [
                'nama' => 'Mobile App Development',
                'slug' => 'mobile-app-development',
                'deskripsi' => 'Pengembangan aplikasi mobile dengan Flutter dan native',
                'harga' => 429000,
                'image' => 'https://images.unsplash.com/photo-1512941691920-25bcd09d16f7?w=400&h=300&fit=crop',
                'pengajar_id' => $pengajarIds[1] ?? $pengajar->id,
                'status' => 'published',
                'durasi_jam' => 32,
                'konten' => 'Pengembangan aplikasi mobile',
            ],
        ];

        foreach ($courses as $course) {
            Kursus::create($course);
        }
    }
}
