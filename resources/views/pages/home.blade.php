@extends('layouts.app')

@section('title', 'Home - Kursus Sriwijaya')

@section('content')
<!-- Hero Section -->
<section class="hero bg-primary text-white py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Wujudkan Masa Depan Gemilang Bersama Sriwijaya Course</h1>
                <p class="lead mb-4">Program belajar yang terstruktur, mentor berpengalaman, dan metode efektif untuk membantu kamu mencapai target akademik dan karier.</p>
                <a href="{{ route('courses') }}" class="btn btn-light btn-lg">Lihat Kursus</a>
            </div>
            <div class="col-lg-6">
                <img src="/Image/Laptop.png" alt="Hero Image" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-book"></i>
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 10H40V40H10Z" stroke="#007bff" stroke-width="2" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Materi Mudah dan Terarah</h5>
                    <p class="text-muted">Materi yang terstruktur dan mudah dipahami bahkan untuk non-IT. Belajar jadi lebih jelas, nggak bikin bingung, dan kamu tahu harus mulai dari mana.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="25" cy="20" r="8" stroke="#007bff" stroke-width="2" />
                            <path d="M15 35C15 30 20 28 25 28C30 28 35 30 35 35" stroke="#007bff" stroke-width="2" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Belajar dari Para Expert</h5>
                    <p class="text-muted">Mentor profesional yang aktif di industri, paham kebutuhan dunia kerja, dan siap bimbing kamu sampai paham.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="15" cy="20" r="5" stroke="#007bff" stroke-width="2" />
                            <circle cx="35" cy="20" r="5" stroke="#007bff" stroke-width="2" />
                            <line x1="20" y1="20" x2="30" y2="20" stroke="#007bff" stroke-width="2" />
                            <path d="M15 28L25 40L35 28" stroke="#007bff" stroke-width="2" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Networking Bertambah Luas</h5>
                    <p class="text-muted">Gabung bareng 200 ribu member komunitas teknologi terbesar. Aktif diskusi, saling dukung, dan bertumbuh bareng.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="28" cy="18" r="6" stroke="#007bff" stroke-width="2" />
                            <path d="M22 28C22 24 25 22 28 22C31 22 34 24 34 28" stroke="#007bff" stroke-width="2" />
                            <path d="M18 40L32 40M25 32V40" stroke="#007bff" stroke-width="2" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Responsif & Solusif</h5>
                    <p class="text-muted">Semua pertanyaan kamu dijawab cepat, jelas, dan selalu ada yang bantu saat kamu butuh.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section class="courses py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Kursus Populer</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Course 1">
                    <div class="card-body">
                        <h5 class="card-title">Web Development</h5>
                        <p class="card-text">Belajar HTML, CSS, JavaScript dan Framework modern.</p>
                        <p class="text-muted">⭐ 4.8 (320 reviews)</p>
                        <a href="{{ route('courses') }}" class="btn btn-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Course 2">
                    <div class="card-body">
                        <h5 class="card-title">Digital Marketing</h5>
                        <p class="card-text">Kuasai strategi marketing digital untuk bisnis online.</p>
                        <p class="text-muted">⭐ 4.7 (250 reviews)</p>
                        <a href="{{ route('courses') }}" class="btn btn-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Course 3">
                    <div class="card-body">
                        <h5 class="card-title">UI/UX Design</h5>
                        <p class="card-text">Desain interface yang menarik dan user experience terbaik.</p>
                        <p class="text-muted">⭐ 4.9 (410 reviews)</p>
                        <a href="{{ route('courses') }}" class="btn btn-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('courses') }}" class="btn btn-primary btn-lg">Lihat Semua Kursus</a>
        </div>
    </div>
</section>

<!-- About Me Section -->
<section class="about py-5" id="about">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="/Image/aboutme.png" alt="Profile" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h1 class="fw-bold mb-4">Tentang Kami</h1>
                <p class="lead mb-3">Sriwijaya Course adalah platform belajar yang berfokus pada pengembangan kemampuan akademik dan profesional melalui program pembelajaran yang terstruktur, interaktif, dan mudah dipahami. Kami menghadirkan berbagai kursus mulai dari bidang teknologi, bisnis, hingga pengembangan diri, dengan pendekatan yang relevan terhadap kebutuhan dunia kerja modern.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-primary">Follow Instagram</a>
                    <a href="#" class="btn btn-outline-primary">Hubungi Saya</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection