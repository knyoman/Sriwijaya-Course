@extends('layouts.app')

@section('title', 'Home - Kursus Sriwijaya')

@section('content')
{{-- Memuat Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Hero Section -->
<style>
    /* 1. Background Gradient Modern dengan Overlay */
    .hero-section {
        background: linear-gradient(135deg, #0d6efd 0%, #0043a8 50%, #001d4a 100%);
        position: relative;
        overflow: hidden;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    /* Overlay Pattern untuk depth */
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        pointer-events: none;
    }

    /* Decorative circles */
    .hero-section::after {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        top: -250px;
        right: -250px;
        animation: pulse 8s ease-in-out infinite;
    }

    /* 2. Animasi Teks - Lebih smooth */
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

    /* 3. Animasi Gambar - Lebih halus dan natural (TIDAK DIGUNAKAN LAGI TAPI DIBIARKAN ADA) */
    @keyframes floatImage {

        0%,
        100% {
            transform: translateY(0px) scale(1);
        }

        50% {
            transform: translateY(-25px) scale(1.02);
        }
    }

    /* 4. Animasi Pulse untuk elemen dekoratif */
    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 0.3;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.5;
        }
    }

    /* 5. Animasi Slide dari kanan */
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

    /* 6. Kelas untuk menerapkan animasi */
    .animate-text {
        opacity: 0;
        animation: fadeInUp 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    /* Penundaan waktu yang lebih teratur */
    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-200 {
        animation-delay: 0.3s;
    }

    .delay-300 {
        animation-delay: 0.5s;
    }

    .delay-400 {
        animation-delay: 0.7s;
    }

    /* Kelas untuk gambar dengan efek lebih keren */
    .hero-img-animate {
        /* PERUBAHAN DISINI: Animasi floatImage dimatikan */
        /* animation: floatImage 6s ease-in-out infinite; */
        animation: none;
        /* Memastikan tidak ada animasi looping */

        max-width: 100%;
        filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.3));
        transition: transform 0.3s ease;
        position: relative;
        z-index: 2;
    }

    /* Efek hover tetap dipertahankan agar sedikit interaktif */
    .hero-img-animate:hover {
        transform: scale(1.05) translateY(-10px);
    }

    /* Container gambar dengan glow effect */
    .hero-img-container {
        position: relative;
        animation: slideInRight 1.2s ease-out forwards;
        opacity: 0;
        animation-delay: 0.4s;
    }

    .hero-img-container::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        height: 80%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
        filter: blur(40px);
        z-index: 1;
        animation: pulse 4s ease-in-out infinite;
    }

    /* Styling Tombol dengan efek modern */
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

    .btn-hero:active {
        transform: translateY(-2px);
    }

    /* Text enhancement */
    .hero-title {
        font-weight: 800;
        line-height: 1.2;
        text-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        letter-spacing: -0.5px;
    }

    .hero-subtitle {
        font-weight: 300;
        line-height: 1.6;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        opacity: 0.95;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .hero-section {
            min-height: auto;
            padding: 60px 0;
        }

        .hero-img-animate {
            max-width: 85%;
        }

        .hero-section::after {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -150px;
        }
    }

    /* Tambahan efek parallax sederhana */
    .parallax-element {
        transition: transform 0.3s ease-out;
    }

    /* Animasi Typing Effect untuk Sriwijaya Course */
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
        display: block;
        border-right: 3px solid #ffdd57;
        overflow: hidden;
        white-space: nowrap;
        animation: typing 3s steps(30, end) infinite, blink 1s step-end infinite;
        font-weight: 700;
        line-height: 1.2;
        margin-top: 0.5rem;
    }

    .typing-text span {
        display: none;
    }

    .typing-text.active {
        animation: typing 3s steps(30, end) infinite, blink 1s step-end infinite;
    }

    /* Style Kartu Baru (Sama seperti dashboard) */
    .transition-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .transition-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1) !important;
    }
</style>

<section class="hero-section text-white py-5">
    <div class="container py-5">
        <div class="row align-items-center">

            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="display-4 fw-bold mb-4 animate-text">
                    Wujudkan Masa Depan Gemilang Bersama
                    <span class="typing-text active">Sriwijaya Course</span>
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
                    <img
                        src="/Image/Laptop.jpg"
                        alt="Belajar Online Sriwijaya Course"
                        class="img-fluid hero-img-animate">
                </div>
            </div>

        </div>
    </div>

    <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; filter: blur(60px);"></div>
</section>


<!-- Features Section -->
<section class="features py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Benefit yang Di Dapatkan</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center p-4 border rounded shadow-sm h-100">
                    <div class="feature-icon mb-3">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 10H40V40H10Z" stroke="#007bff" stroke-width="2" />
                            <path d="M15 20H35M15 28H35M15 35H25" stroke="#007bff" stroke-width="2" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Materi Mudah dan Terarah</h5>
                    <p class="text-muted">Materi yang terstruktur dan mudah dipahami bahkan untuk non-IT.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center p-4 border rounded shadow-sm h-100">
                    <div class="feature-icon mb-3">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="28" cy="18" r="6" stroke="#007bff" stroke-width="2" />
                            <path d="M22 28C22 24 25 22 28 22C31 22 34 24 34 28" stroke="#007bff" stroke-width="2" />
                            <path d="M18 40L32 40M25 32V40" stroke="#007bff" stroke-width="2" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Responsif & Solusif</h5>
                    <p class="text-muted">Semua pertanyaan dijawab cepat, jelas, dan selalu ada yang bantu saat di butuh.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center p-4 border rounded shadow-sm h-100">
                    <div class="feature-icon mb-3">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25 5L32 20H48L36 29L41 44L25 35L9 44L14 29L2 20H18L25 5Z" stroke="#007bff" stroke-width="2" fill="none" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Sertifikat Resmi</h5>
                    <p class="text-muted">Dapatkan sertifikat setelah menyelesaikan setiap kursus.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center p-4 border rounded shadow-sm h-100">
                    <div class="feature-icon mb-3">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 20C15 15 20 12 25 12C30 12 35 15 35 20C35 28 25 38 25 38C25 38 15 28 15 20Z" stroke="#007bff" stroke-width="2" fill="none" />
                            <circle cx="25" cy="20" r="3" fill="#007bff" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Pembelajaran Fleksibel</h5>
                    <p class="text-muted">Belajar kapan saja, di mana saja sesuai kecepatan dan jadwal sendiri tanpa tekanan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Courses Section (DIPERBARUI) -->
<section class="courses py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Kursus Populer</h2>
        <div class="row g-4">
            @forelse($courses->take(3) as $course)

            {{-- Logika Enrollment --}}
            @php
            $isEnrolled = auth()->check() && auth()->user()->peran === 'pelajar' && auth()->user()->enrolledCourses()->where('kursus_id', $course->id)->exists();
            @endphp

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden transition-hover">

                    {{-- Gambar (Aspect Ratio 16:9) --}}
                    <div class="position-relative" style="aspect-ratio: 16/9; overflow: hidden;">
                        <img src="{{ $course->image ?: 'https://via.placeholder.com/640x360?text=' . urlencode($course->nama) }}"
                            class="w-100 h-100"
                            alt="{{ $course->nama }}"
                            style="object-fit: cover; object-position: center;">

                        {{-- Badge Kategori --}}
                        <div class="position-absolute top-0 start-0 m-2">
                            <span class="badge bg-white text-primary fw-bold shadow-sm px-2 py-1 rounded-pill small">
                                Kursus
                            </span>
                        </div>
                    </div>

                    {{-- Card Body (Compact Padding p-3) --}}
                    <div class="card-body d-flex flex-column p-3">

                        {{-- Info Pengajar --}}
                        <div class="d-flex align-items-center mb-1 text-muted small" style="font-size: 0.8rem;">
                            <i class="bi bi-person-circle me-1 text-secondary"></i>
                            <span class="fw-medium text-truncate">{{ $course->pengajar->nama ?? 'Instruktur Sriwijaya' }}</span>
                        </div>

                        {{-- Judul Kursus --}}
                        <h6 class="card-title fw-bold text-dark mb-1" style="font-size: 1.1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.6rem; line-height: 1.3rem;">
                            {{ $course->nama }}
                        </h6>

                        {{-- Deskripsi Singkat --}}
                        <p class="card-text text-muted small mb-2" style="font-size: 0.85rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.4;">
                            {{ Str::limit($course->deskripsi, 80) }}
                        </p>

                        {{-- Info Meta (Durasi & Siswa) --}}
                        <div class="d-flex gap-3 mb-3 text-secondary small border-top pt-2" style="font-size: 0.8rem;">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock me-1 text-warning"></i>
                                <span>{{ $course->durasi_jam }} Jam</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-people me-1 text-info"></i>
                                <span>{{ $course->pelajar_count ?? 0 }} Siswa</span>
                            </div>
                        </div>

                        {{-- Footer: Harga & Tombol --}}
                        <div class="mt-auto d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.7rem;">Harga</small>
                                {{-- Warna Harga: Biru jika belum daftar, Hijau jika sudah --}}
                                <span class="fw-bold {{ $isEnrolled ? 'text-success' : 'text-primary' }} fs-5">
                                    Rp {{ number_format($course->harga, 0, ',', '.') }}
                                </span>
                            </div>

                            {{-- Logika Tombol Aksi --}}
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
                                {{-- Untuk Admin/Pengajar --}}
                                <a href="{{ route('course.detail', $course->slug ?? $course->id) }}" class="btn btn-primary rounded-pill fw-bold px-3 py-1 btn-sm shadow-sm">
                                    Detail
                                </a>
                                @endif
                                @else
                                {{-- Untuk Tamu --}}
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
            <a href="{{ route('courses') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">Lihat Semua Kursus</a>
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
                <h2 class="fw-bold mb-4">Tentang Kami</h2>
                <p class="lead mb-3">Sriwijaya Course adalah platform belajar yang berfokus pada pengembangan kemampuan akademik dan profesional melalui program pembelajaran yang terstruktur, interaktif, dan mudah dipahami. Kami menghadirkan berbagai kursus mulai dari bidang teknologi, bisnis, hingga pengembangan diri, dengan pendekatan yang relevan terhadap kebutuhan dunia kerja modern.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-primary">Follow Instagram</a>
                    <a href="#" class="btn btn-outline-primary">Hubungi Saya</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Sriwijaya Course Section -->
<section class="why-sriwijaya py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-2 fw-bold" style="font-size: 2.5rem;">Mengapa SRIWIJAYA COURSE</h2>
        <div class="row">
            <div class="col-lg-12">
                <!-- Accordion -->
                <div class="accordion" id="accordionSriwijaya">
                    <!-- Item 1 -->
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                Mentor Profesional, Bukan Sekadar Pengajar
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#accordionSriwijaya">
                            <div class="accordion-body">
                                <p>Belajar langsung dari praktisi industri yang masih aktif dan tahu kebutuhan dunia kerja saat ini. Mentor kami bukan hanya mengajar teori, tapi berbagi pengalaman nyata, tips praktis, dan cara menghadapi tantangan industri yang sebenarnya.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                Materi Up-to-Date & Rute Belajar yang Jelas
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionSriwijaya">
                            <div class="accordion-body">
                                <p>Kurikulum kami selalu diperbarui mengikuti perkembangan teknologi terkini. Setiap kursus dirancang dengan roadmap yang jelas, dari fundamental hingga advanced, sehingga kamu tahu persis harus belajar apa dan dalam urutan apa.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                Support Responsif 24/7
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionSriwijaya">
                            <div class="accordion-body">
                                <p>Tim support kami siap membantu kapan saja. Pertanyaan dijawab cepat, masalah teknis diselesaikan segera, dan kamu tidak akan pernah merasa sendirian dalam perjalanan belajar.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                Sertifikat yang Diakui Industri
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionSriwijaya">
                            <div class="accordion-body">
                                <p>Setiap sertifikat Sriwijaya Course diakui oleh perusahaan-perusahaan besar. Tambahkan nilai pada CV kamu dan tingkatkan peluang karier dengan kredibilitas yang kami berikan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold" style="font-size: 2.5rem;">Apa Kata Mereka</h2>
        <div class="row g-4">
            <!-- Testimoni 1 -->
            <div class="col-md-4">
                <div class="testimonial-card p-4 border rounded shadow-sm bg-white h-100">
                    <div class="d-flex mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="mb-4">"Sriwijaya Course benar-benar mengubah cara saya belajar. Mentornya sangat responsif dan materi yang diberikan sangat relevan dengan industri. Sekarang saya sudah bisa mendapatkan pekerjaan di bidang yang saya impikan!"</p>
                    <div class="d-flex align-items-center">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=faces"
                            alt="Ade Pratama"
                            class="rounded-circle me-3"
                            style="width: 60px; height: 60px; object-fit: cover;">
                        <div>
                            <h6 class="mb-0 fw-bold">Ade Pratama</h6>
                            <small class="text-muted">Frontend Developer</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimoni 2 -->
            <div class="col-md-4">
                <div class="testimonial-card p-4 border rounded shadow-sm bg-white h-100">
                    <div class="d-flex mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="mb-4">"Saya terkesan dengan komunitas yang sangat supportif dan mentor yang berpengalaman. Tidak hanya belajar skill teknis, tapi juga soft skill yang sangat penting untuk karier. Recommended banget!"</p>
                    <div class="d-flex align-items-center">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&h=150&fit=crop&crop=faces"
                            alt="Siti Nurhaliza"
                            class="rounded-circle me-3"
                            style="width: 60px; height: 60px; object-fit: cover;">
                        <div>
                            <h6 class="mb-0 fw-bold">Siti Nurhaliza</h6>
                            <small class="text-muted">Digital Marketing Specialist</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimoni 3 -->
            <div class="col-md-4">
                <div class="testimonial-card p-4 border rounded shadow-sm bg-white h-100">
                    <div class="d-flex mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="mb-4">"Materi terstruktur dengan baik dan cara pengajaran yang mudah dipahami. Saya dari background non-IT dan sekarang sudah bisa membuat website sendiri. Terima kasih Sriwijaya Course!"</p>
                    <div class="d-flex align-items-center">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop&crop=faces"
                            alt="Budi Santoso"
                            class="rounded-circle me-3"
                            style="width: 60px; height: 60px; object-fit: cover;">
                        <div>
                            <h6 class="mb-0 fw-bold">Budi Santoso</h6>
                            <small class="text-muted">UI/UX Designer</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Siap Memulai Perjalanan Belajar Kamu?</h2>
        <p class="lead mb-4">Daftar sekarang dan dapatkan akses ke ribuan kursus berkualitas tinggi</p>
        <a href="{{ route('courses') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold shadow">Mulai Belajar Sekarang</a>
    </div>
</section>

@endsection