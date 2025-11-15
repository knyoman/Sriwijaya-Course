<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseDetailController extends Controller
{
    public function show($slug)
    {
        $courses = [
            'web-development' => [
                'name' => 'Web Development',
                'price' => 'Rp 299.000',
                'image' => 'https://images.unsplash.com/photo-1593720213428-28a5b9e94613?w=800&h=400&fit=crop',
                'description' => 'Pelajari HTML, CSS, JavaScript dan framework modern untuk membangun website profesional.',
                'duration' => '12 Minggu',
                'level' => 'Pemula - Menengah',
                'instructor' => 'Budi Santoso',
                'chapters' => [
                    ['title' => 'Intro HTML & CSS', 'lessons' => 5],
                    ['title' => 'JavaScript Dasar', 'lessons' => 8],
                    ['title' => 'DOM & Event Handling', 'lessons' => 6],
                    ['title' => 'Bootstrap Framework', 'lessons' => 7],
                    ['title' => 'Intro React.js', 'lessons' => 10],
                    ['title' => 'Project: Build Website', 'lessons' => 4],
                ]
            ],
            'digital-marketing' => [
                'name' => 'Digital Marketing',
                'price' => 'Rp 299.000',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=400&fit=crop',
                'description' => 'Kuasai strategi pemasaran digital, SEO, social media marketing dan iklan online.',
                'duration' => '10 Minggu',
                'level' => 'Pemula',
                'instructor' => 'Siti Nurhaliza',
                'chapters' => [
                    ['title' => 'Fondasi Digital Marketing', 'lessons' => 6],
                    ['title' => 'SEO & SEM', 'lessons' => 8],
                    ['title' => 'Social Media Marketing', 'lessons' => 7],
                    ['title' => 'Email Marketing', 'lessons' => 5],
                    ['title' => 'Analytics & Reporting', 'lessons' => 6],
                    ['title' => 'Campaign Strategy', 'lessons' => 8],
                ]
            ],
            'ui-ux-design' => [
                'name' => 'UI/UX Design',
                'price' => 'Rp 299.000',
                'image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=800&h=400&fit=crop',
                'description' => 'Belajar merancang antarmuka yang menarik dan pengalaman pengguna yang optimal.',
                'duration' => '11 Minggu',
                'level' => 'Pemula - Menengah',
                'instructor' => 'Rini Pratiwi',
                'chapters' => [
                    ['title' => 'Design Thinking Basics', 'lessons' => 5],
                    ['title' => 'Wireframing & Prototyping', 'lessons' => 7],
                    ['title' => 'User Research', 'lessons' => 6],
                    ['title' => 'Visual Design Principles', 'lessons' => 8],
                    ['title' => 'Figma Mastery', 'lessons' => 9],
                    ['title' => 'Portfolio Project', 'lessons' => 6],
                ]
            ],
            'data-science' => [
                'name' => 'Data Science',
                'price' => 'Rp 299.000',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=400&fit=crop',
                'description' => 'Analisis data, machine learning, dan visualisasi data untuk keputusan bisnis.',
                'duration' => '14 Minggu',
                'level' => 'Menengah - Lanjut',
                'instructor' => 'Dr. Adi Wijaya',
                'chapters' => [
                    ['title' => 'Python for Data Science', 'lessons' => 8],
                    ['title' => 'Data Cleaning & Preparation', 'lessons' => 7],
                    ['title' => 'Exploratory Data Analysis', 'lessons' => 6],
                    ['title' => 'Statistical Analysis', 'lessons' => 8],
                    ['title' => 'Machine Learning Basics', 'lessons' => 10],
                    ['title' => 'Advanced ML & Deep Learning', 'lessons' => 9],
                ]
            ],
            'mobile-app-development' => [
                'name' => 'Mobile App Development',
                'price' => 'Rp 299.000',
                'image' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800&h=400&fit=crop',
                'description' => 'Kembangkan aplikasi mobile Android dan iOS dengan React Native atau Flutter.',
                'duration' => '13 Minggu',
                'level' => 'Menengah',
                'instructor' => 'Ahmad Ridho',
                'chapters' => [
                    ['title' => 'Flutter Basics', 'lessons' => 7],
                    ['title' => 'Dart Programming', 'lessons' => 8],
                    ['title' => 'UI Components & Widgets', 'lessons' => 9],
                    ['title' => 'State Management', 'lessons' => 7],
                    ['title' => 'API Integration', 'lessons' => 6],
                    ['title' => 'Build Real Apps', 'lessons' => 8],
                ]
            ],
            'graphic-design' => [
                'name' => 'Graphic Design',
                'price' => 'Rp 299.000',
                'image' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?w=800&h=400&fit=crop',
                'description' => 'Menguasai desain grafis dengan Adobe Photoshop, Illustrator, dan tools modern.',
                'duration' => '12 Minggu',
                'level' => 'Pemula - Menengah',
                'instructor' => 'Dewi Kusuma',
                'chapters' => [
                    ['title' => 'Design Fundamentals', 'lessons' => 6],
                    ['title' => 'Adobe Photoshop Mastery', 'lessons' => 10],
                    ['title' => 'Adobe Illustrator', 'lessons' => 9],
                    ['title' => 'Typography & Color Theory', 'lessons' => 6],
                    ['title' => 'Branding & Logo Design', 'lessons' => 7],
                    ['title' => 'Portfolio Projects', 'lessons' => 8],
                ]
            ],
        ];

        $course = $courses[$slug] ?? null;

        if (!$course) {
            abort(404);
        }

        return view('pages.course-detail', compact('course', 'slug'));
    }
}
?>