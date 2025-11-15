@extends('layouts.app')

@section('title', 'Kursus - Kursus Sriwijaya')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">Semua Kursus Kami</h1>
    <div class="row g-4">
        <!-- Kursus 1: Web Development -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="https://images.unsplash.com/photo-1593720213428-28a5b9e94613?w=400&h=250&fit=crop" class="card-img-top" alt="Web Development">
                <div class="card-body">
                    <h5 class="card-title">Web Development</h5>
                    <p class="card-text">Pelajari HTML, CSS, JavaScript dan framework modern untuk membangun website profesional.</p>
                    <p class="text-danger fw-bold">Rp 299.000</p>
                    <a href="{{ route('course.detail', 'web-development') }}" class="btn btn-primary w-100">Daftar Sekarang</a>
                </div>
            </div>
        </div>

        <!-- Kursus 2: Digital Marketing -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=250&fit=crop" class="card-img-top" alt="Digital Marketing">
                <div class="card-body">
                    <h5 class="card-title">Digital Marketing</h5>
                    <p class="card-text">Kuasai strategi pemasaran digital, SEO, social media marketing dan iklan online.</p>
                    <p class="text-danger fw-bold">Rp 299.000</p>
                    <a href="{{ route('course.detail', 'digital-marketing') }}" class="btn btn-primary w-100">Daftar Sekarang</a>
                </div>
            </div>
        </div>

        <!-- Kursus 3: UI/UX Design -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=400&h=250&fit=crop" class="card-img-top" alt="UI/UX Design">
                <div class="card-body">
                    <h5 class="card-title">UI/UX Design</h5>
                    <p class="card-text">Belajar merancang antarmuka yang menarik dan pengalaman pengguna yang optimal.</p>
                    <p class="text-danger fw-bold">Rp 299.000</p>
                    <a href="{{ route('course.detail', 'ui-ux-design') }}" class="btn btn-primary w-100">Daftar Sekarang</a>
                </div>
            </div>
        </div>

        <!-- Kursus 4: Data Science -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=250&fit=crop" class="card-img-top" alt="Data Science">
                <div class="card-body">
                    <h5 class="card-title">Data Science</h5>
                    <p class="card-text">Analisis data, machine learning, dan visualisasi data untuk keputusan bisnis.</p>
                    <p class="text-danger fw-bold">Rp 299.000</p>
                    <a href="{{ route('course.detail', 'data-science') }}" class="btn btn-primary w-100">Daftar Sekarang</a>
                </div>
            </div>
        </div>

        <!-- Kursus 5: Mobile App Development -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&h=250&fit=crop" class="card-img-top" alt="Mobile App Development">
                <div class="card-body">
                    <h5 class="card-title">Mobile App Development</h5>
                    <p class="card-text">Kembangkan aplikasi mobile Android dan iOS dengan React Native atau Flutter.</p>
                    <p class="text-danger fw-bold">Rp 299.000</p>
                    <a href="{{ route('course.detail', 'mobile-app-development') }}" class="btn btn-primary w-100">Daftar Sekarang</a>
                </div>
            </div>
        </div>

        <!-- Kursus 6: Graphic Design -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="https://images.unsplash.com/photo-1626785774573-4b799315345d?w=400&h=250&fit=crop" class="card-img-top" alt="Graphic Design">
                <div class="card-body">
                    <h5 class="card-title">Graphic Design</h5>
                    <p class="card-text">Menguasai desain grafis dengan Adobe Photoshop, Illustrator, dan tools modern.</p>
                    <p class="text-danger fw-bold">Rp 299.000</p>
                    <a href="{{ route('course.detail', 'graphic-design') }}" class="btn btn-primary w-100">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection