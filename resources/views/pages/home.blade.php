@extends('layouts.app')

@section('title', 'Home - Kursus Sriwijaya')

@section('content')
{{-- Memuat Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .hero-section {
        background: linear-gradient(135deg, #0d6efd 0%, #0043a8 50%, #001d4a 100%);
        position: relative;
        overflow: hidden;
        min-height: 100vh;
        display: flex;
        align-items: center;
        z-index: 0;
    }

    .hero-shape-left {
        position: absolute;
        top: 0;
        left: 0;
        width: 60%;
        height: 100%;
        background: #003380;
        clip-path: ellipse(80% 90% at 0% 50%);
        opacity: 0.6;
        z-index: -1;
        animation: floatShape 10s ease-in-out infinite alternate;
    }

    .hero-shape-right {
        position: absolute;
        bottom: -10%;
        right: 0;
        width: 70%;
        height: 110%;
        background: #1a75ff;
        clip-path: ellipse(90% 70% at 100% 80%);
        opacity: 0.5;
        z-index: -1;
        animation: floatShape 12s ease-in-out infinite alternate-reverse;
    }

    .hero-shape-top-right {
        position: absolute;
        top: -10%;
        right: -10%;
        width: 40%;
        height: 50%;
        background: #4dabff;
        clip-path: ellipse(60% 60% at 100% 0%);
        opacity: 0.3;
        z-index: -1;
        animation: floatShape 8s ease-in-out infinite alternate;
    }

    @keyframes floatShape {
        0% {
            transform: translate(0, 0) scale(1);
        }

        100% {
            transform: translate(20px, 15px) scale(1.03);
        }
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%), radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        pointer-events: none;
        z-index: -2;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
            filter: blur(5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-text {
        opacity: 0;
        animation: fadeInUp 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-200 {
        animation-delay: 0.3s;
    }

    .delay-300 {
        animation-delay: 0.5s;
    }

    .tilt-wrapper {
        position: relative;
        display: inline-block;
        perspective: 1000px;
        z-index: 2;
        padding: 20px;
    }

    .tilt-wrapper::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 120%;
        height: 120%;
        background: linear-gradient(45deg, #0d6efd, #0dcaf0, #6610f2);
        filter: blur(60px);
        opacity: 0.5;
        z-index: -1;
        border-radius: 50%;
        animation: pulseGlow 8s ease-in-out infinite alternate;
        transition: all 0.3s ease;
    }

    .tilt-image {
        max-width: 100%;
        filter: drop-shadow(0 15px 30px rgba(13, 110, 253, 0.3));
        transition: transform 0.1s ease-out;
        position: relative;
        z-index: 2;
        will-change: transform;
    }

    .tilt-wrapper:hover::before {
        opacity: 0.8;
        filter: blur(50px);
        width: 130%;
        height: 130%;
    }

    @keyframes pulseGlow {
        0% {
            opacity: 0.4;
            transform: translate(-50%, -50%) scale(0.9);
        }

        100% {
            opacity: 0.6;
            transform: translate(-50%, -50%) scale(1.1);
        }
    }

    .btn-hero {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        border-radius: 50px;
        padding: 12px 32px;
        font-weight: 600;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .btn-hero::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
        z-index: -1;
    }

    .btn-hero:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
    }

    .btn-hero:hover::before {
        width: 300px;
        height: 300px;
    }

    @keyframes typing {
        from {
            width: 0;
        }

        to {
            width: 100%;
        }
    }

    @keyframes blink {
        50% {
            border-right-color: transparent;
        }
    }

    .typing-text {
        color: #ffdd57;
        display: inline-block;
        border-right: 3px solid #ffdd57;
        overflow: hidden;
        white-space: nowrap;
        vertical-align: bottom;
        animation: typing 3s steps(30, end) infinite, blink 1s step-end infinite;
    }

    @media (max-width: 768px) {
        .hero-section {
            min-height: auto;
            padding: 80px 0 60px 0;
        }

        .hero-shape-left {
            width: 90%;
            clip-path: ellipse(90% 80% at 0% 40%);
        }

        .hero-shape-right {
            width: 100%;
            height: 80%;
            bottom: 0;
            clip-path: ellipse(100% 60% at 100% 100%);
        }

        .tilt-wrapper::before {
            width: 100%;
            height: 100%;
            filter: blur(40px);
        }
    }

    /* --- ADDITIONAL CUSTOM STYLES FOR NEW SECTIONS --- */
    .section-title {
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
        margin-bottom: 3rem;
        font-weight: 800;
        color: #001d4a;
    }

    .section-title::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: #0d6efd;
        border-radius: 2px;
    }

    /* (BARU) Style untuk Kategori Bergerak (Marquee Pill) */
    .marquee-container {
        overflow: hidden;
        white-space: nowrap;
        padding: 25px 0;
        position: relative;
    }

    .marquee-container::before,
    .marquee-container::after {
        content: "";
        position: absolute;
        top: 0;
        width: 150px;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }

    .marquee-container::before {
        left: 0;
        background: linear-gradient(to right, #f8f9fa, transparent);
    }

    .marquee-container::after {
        right: 0;
        background: linear-gradient(to left, #f8f9fa, transparent);
    }

    .marquee-track {
        display: inline-block;
        animation: marqueeScroll 35s linear infinite;
    }

    .marquee-track:hover {
        animation-play-state: paused;
    }

    @keyframes marqueeScroll {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(-50%);
        }
    }

    .category-pill {
        display: inline-block;
        background: #fff;
        color: #333;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .category-pill:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.2);
        color: #0d6efd;
        background: #fff;
    }

    /* Feature Card Upgrade */
    .feature-card-modern {
        border: none;
        background: #fff;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .feature-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .feature-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 0;
        background: #0d6efd;
        transition: height 0.3s ease;
    }

    .feature-card-modern:hover::before {
        height: 100%;
    }

    /* Testimonial Upgrade */
    .testimonial-card-modern {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        position: relative;
        height: 100%;
    }

    .quote-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 3rem;
        color: rgba(13, 110, 253, 0.1);
    }

    /* CTA Upgrade */
    .cta-modern {
        background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);
        position: relative;
        overflow: hidden;
    }

    .cta-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
</style>

<section class="hero-section text-white py-5">
    <div class="hero-shape-left"></div>
    <div class="hero-shape-right"></div>
    <div class="hero-shape-top-right"></div>
    <div class="container py-5 position-relative" style="z-index: 3;">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="display-4 fw-bold mb-4 animate-text">
                    Wujudkan Masa Depan Gemilang Bersama<br>
                    <span class="typing-text">Sriwijaya Course</span>
                </h1>
                <p class="lead mb-4 animate-text delay-100" style="opacity: 0.9;">
                    Program belajar yang terstruktur, mentor berpengalaman, dan metode efektif untuk membantu kamu mencapai target akademik dan karier.
                </p>
                <div class="animate-text delay-200">
                    <a href="{{ route('courses') }}" class="btn btn-light btn-lg px-4 py-2 btn-hero fw-bold text-primary">
                        Lihat Kursus <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-end">
                <div class="animate-text delay-300">
                    <div class="tilt-wrapper" id="tiltCard">
                        <img src="/Image/Laptop.png" alt="Belajar Online" class="img-fluid tilt-image" id="tiltImage">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const card = document.getElementById('tiltCard');
        const img = document.getElementById('tiltImage');
        if (card && img) {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = ((y - centerY) / centerY) * -15;
                const rotateY = ((x - centerX) / centerX) * 15;
                img.style.transform = `scale(1.05) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });
            card.addEventListener('mouseleave', () => {
                img.style.transform = `scale(1) rotateX(0) rotateY(0)`;
            });
        }
    });
</script>

<section class="py-4 bg-light border-bottom border-top overflow-hidden">
    <div class="marquee-container">
        <div class="marquee-track">
            <a href="#" class="category-pill mx-3">Microsoft Office</a>
            <a href="#" class="category-pill mx-3">Python Development</a>
            <a href="#" class="category-pill mx-3">Data Engineering</a>
            <a href="#" class="category-pill mx-3">Frontend Web</a>
            <a href="#" class="category-pill mx-3">Backend Development</a>
            <a href="#" class="category-pill mx-3">Digital Marketing</a>
            <a href="#" class="category-pill mx-3">UI/UX Design</a>
            <a href="#" class="category-pill mx-3">Data Science</a>

            <a href="#" class="category-pill mx-3">Microsoft Office</a>
            <a href="#" class="category-pill mx-3">Python Development</a>
            <a href="#" class="category-pill mx-3">Data Engineering</a>
            <a href="#" class="category-pill mx-3">Frontend Web</a>
            <a href="#" class="category-pill mx-3">Backend Development</a>
            <a href="#" class="category-pill mx-3">Digital Marketing</a>
            <a href="#" class="category-pill mx-3">UI/UX Design</a>
            <a href="#" class="category-pill mx-3">Data Science</a>
        </div>
    </div>
</section>

<section class="features py-5 bg-white">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Kenapa Memilih Kami?</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card-modern bg-light border">
                    <div class="mb-4 text-primary">
                        <i class="bi bi-journal-code fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Materi Terstruktur</h5>
                    <p class="text-muted">Kurikulum disusun sistematis dari dasar hingga mahir agar mudah dipahami oleh pemula.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card-modern bg-light border">
                    <div class="mb-4 text-primary">
                        <i class="bi bi-people fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Mentor Support</h5>
                    <p class="text-muted">Bingung saat belajar? Mentor kami siap membantu menjawab pertanyaanmu di grup diskusi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card-modern bg-light border">
                    <div class="mb-4 text-primary">
                        <i class="bi bi-award fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Sertifikat Resmi</h5>
                    <p class="text-muted">Dapatkan sertifikat kompetensi setelah menyelesaikan kursus untuk portofolio kariermu.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card-modern bg-light border">
                    <div class="mb-4 text-primary">
                        <i class="bi bi-infinity fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Akses Seumur Hidup</h5>
                    <p class="text-muted">Bayar sekali, akses materinya selamanya. Belajar kapan saja dan di mana saja tanpa batas.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="courses py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Kursus Unggulan</h2>
            <p class="text-muted">Pilihan kursus terbaik yang paling banyak diminati siswa</p>
        </div>

        <div class="row g-4">
            @forelse($courses->take(3) as $course)
            @php
            $isEnrolled = auth()->check() && auth()->user()->peran === 'pelajar' && auth()->user()->enrolledCourses()->where('kursus_id', $course->id)->exists();
            @endphp

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden transition-hover bg-light border">
                    <div class="position-relative" style="aspect-ratio: 16/9; overflow: hidden;">
                        <img src="{{ $course->image ?: 'https://via.placeholder.com/640x360?text=' . urlencode($course->nama) }}"
                            class="w-100 h-100"
                            alt="{{ $course->nama }}"
                            style="object-fit: cover; object-position: center;">
                        <div class="position-absolute top-0 start-0 m-2">
                            <span class="badge bg-white text-primary fw-bold shadow-sm px-2 py-1 rounded-pill small">
                                Kursus
                            </span>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column p-3">
                        <div class="d-flex align-items-center mb-1 text-muted small" style="font-size: 0.8rem;">
                            <i class="bi bi-person-circle me-1 text-secondary"></i>
                            <span class="fw-medium text-truncate">{{ $course->pengajar->nama ?? 'Instruktur Sriwijaya' }}</span>
                        </div>

                        <h6 class="card-title fw-bold text-dark mb-1" style="font-size: 1.1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.6rem; line-height: 1.3rem;">
                            {{ $course->nama }}
                        </h6>

                        <p class="card-text text-muted small mb-2" style="font-size: 0.85rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.4;">
                            {{ Str::limit($course->deskripsi, 80) }}
                        </p>

                        <div class="d-flex gap-3 mb-3 text-secondary small border-top border-secondary-subtle pt-2" style="font-size: 0.8rem;">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock me-1 text-warning"></i>
                                <span>{{ $course->durasi_jam }} Jam</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-people me-1 text-info"></i>
                                <span>{{ $course->pelajar_count ?? 0 }} Siswa</span>
                            </div>
                        </div>

                        <div class="mt-auto d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.7rem;">Harga</small>
                                <span class="fw-bold {{ $isEnrolled ? 'text-success' : 'text-primary' }} fs-5">
                                    Rp {{ number_format($course->harga, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="d-flex">
                                @auth
                                @if(auth()->user()->peran === 'pelajar')
                                @if($isEnrolled)
                                <a href="{{ route('student.course-learn', $course->id) }}" class="btn btn-outline-success rounded-pill fw-bold px-3 py-1 btn-sm">
                                    Lanjut
                                </a>
                                @else
                                <form action="{{ route('student.course.enroll', $course->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary rounded-pill fw-bold px-3 py-1 btn-sm shadow-sm">
                                        Daftar
                                    </button>
                                </form>
                                @endif
                                @else
                                <a href="{{ route('course.detail', $course->slug ?? $course->id) }}" class="btn btn-primary rounded-pill fw-bold px-3 py-1 btn-sm shadow-sm">
                                    Detail
                                </a>
                                @endif
                                @else
                                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill fw-bold px-3 py-1 btn-sm shadow-sm">
                                    Daftar
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Tidak ada kursus yang tersedia saat ini</div>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('courses') }}" class="btn btn-outline-primary btn-lg rounded-pill px-5">Lihat Semua Kursus</a>
        </div>
    </div>
</section>

<section class="about py-5 bg-light" id="about">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 position-relative">
                <div class="position-absolute top-0 start-0 translate-middle rounded-circle bg-warning opacity-25" style="width: 200px; height: 200px; z-index: 0; filter: blur(40px);"></div>
                <div class="position-absolute bottom-0 end-0 translate-middle rounded-circle bg-primary opacity-25" style="width: 150px; height: 150px; z-index: 0; filter: blur(40px);"></div>

                <img src="/Image/aboutme.png"
                    alt="Profile"
                    class="img-fluid rounded-4 shadow-lg position-relative"
                    style="z-index: 1;"
                    onerror="this.src='https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
            </div>
            <div class="col-lg-6">
                <span class="badge bg-primary bg-opacity-10 text-primary mb-2 px-3 py-2 rounded-pill">TENTANG KAMI</span>
                <h2 class="fw-bold mb-4 display-6 text-dark">Platform Belajar Masa Depan untuk Karier Cemerlang</h2>
                <p class="text-muted mb-4" style="line-height: 1.8;">
                    Sriwijaya Course adalah platform belajar yang berfokus pada pengembangan kemampuan akademik dan profesional. Kami percaya bahwa pendidikan berkualitas harus dapat diakses oleh siapa saja.
                </p>
                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                        <span class="fw-medium">Kurikulum Standar Industri</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                        <span class="fw-medium">Belajar Fleksibel Sesuai Waktu Kamu</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                        <span class="fw-medium">Komunitas Diskusi yang Aktif</span>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-primary rounded-pill px-4">Hubungi Kami</a>
                    <a href="#" class="btn btn-outline-dark rounded-pill px-4">Lihat Profil</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="why-sriwijaya py-5 bg-white position-relative overflow-hidden">
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4 display-6">Mengapa Siswa Memilih <br><span class="text-primary">Sriwijaya Course?</span></h2>
                <p class="text-muted mb-4">Kami tidak hanya memberikan materi, tetapi pengalaman belajar yang mengubah cara pandangmu terhadap skill baru.</p>
                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 py-2">Gabung Sekarang <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
            <div class="col-lg-7">
                <div class="accordion shadow-sm rounded-3 overflow-hidden" id="accordionSriwijaya">
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true">
                                <i class="bi bi-briefcase me-3 text-primary fs-5"></i> Mentor Praktisi
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#accordionSriwijaya">
                            <div class="accordion-body text-muted pt-0 pb-3 ps-5 ms-2">
                                Belajar langsung dari praktisi industri yang masih aktif. Dapatkan wawasan nyata tentang dunia kerja, bukan hanya teori buku.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold collapsed py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                <i class="bi bi-journal-bookmark me-3 text-primary fs-5"></i> Kurikulum Up-to-Date
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionSriwijaya">
                            <div class="accordion-body text-muted pt-0 pb-3 ps-5 ms-2">
                                Materi selalu diperbarui mengikuti tren teknologi terkini. Roadmap belajar jelas dari nol sampai mahir.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold collapsed py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                <i class="bi bi-headset me-3 text-primary fs-5"></i> Support 24/7
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionSriwijaya">
                            <div class="accordion-body text-muted pt-0 pb-3 ps-5 ms-2">
                                Tim support dan mentor siap membantu kendala belajarmu kapan saja. Kamu tidak akan belajar sendirian.
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonials py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Kata Mereka Tentang Kami</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="testimonial-card-modern">
                    <i class="bi bi-quote quote-icon"></i>
                    <div class="d-flex text-warning mb-3">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-muted mb-4" style="font-style: italic;">"Materi yang diajarkan sangat daging! Saya yang awalnya nol besar di coding sekarang sudah bisa bikin website portofolio sendiri."</p>
                    <div class="d-flex align-items-center pt-3 border-top">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop" alt="User" class="rounded-circle me-3" width="50" height="50">
                        <div>
                            <h6 class="fw-bold mb-0">Ade Pratama</h6>
                            <small class="text-muted">Alumni Web Dev</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card-modern">
                    <i class="bi bi-quote quote-icon"></i>
                    <div class="d-flex text-warning mb-3">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-muted mb-4" style="font-style: italic;">"Platformnya mudah digunakan, videonya HD dan jelas. Yang paling saya suka adalah respon mentornya yang cepat."</p>
                    <div class="d-flex align-items-center pt-3 border-top">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" alt="User" class="rounded-circle me-3" width="50" height="50">
                        <div>
                            <h6 class="fw-bold mb-0">Siti Nurhaliza</h6>
                            <small class="text-muted">Digital Marketer</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card-modern">
                    <i class="bi bi-quote quote-icon"></i>
                    <div class="d-flex text-warning mb-3">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-muted mb-4" style="font-style: italic;">"Sertifikat dari Sriwijaya Course sangat membantu saya melamar kerja. HRD jadi lebih yakin dengan skill saya."</p>
                    <div class="d-flex align-items-center pt-3 border-top">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop" alt="User" class="rounded-circle me-3" width="50" height="50">
                        <div>
                            <h6 class="fw-bold mb-0">Budi Santoso</h6>
                            <small class="text-muted">Graphic Designer</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-modern py-5 text-white">
    <div class="container text-center position-relative" style="z-index: 2;">
        <h2 class="fw-bold mb-3 display-5">Siap Upgrade Skill Kamu?</h2>
        <p class="lead mb-4 opacity-75">Bergabunglah dengan ribuan siswa lainnya dan mulai perjalanan kariermu hari ini.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('courses') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary shadow">Mulai Belajar</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg rounded-pill px-5 fw-bold">Daftar Akun</a>
        </div>
    </div>
</section>

@endsection