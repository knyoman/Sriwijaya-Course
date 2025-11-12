@extends('layouts.app')

@section('title', 'Home - Kursus Sriwijaya')

@section('content')
<!-- Hero Section -->
<section class="hero bg-primary text-white py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <!-- Teks -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold mb-4">
                    Wujudkan Masa Depan Gemilang Bersama Sriwijaya Course
                </h1>
                <p class="lead mb-4">
                    Program belajar yang terstruktur, mentor berpengalaman, dan metode efektif untuk membantu kamu mencapai target akademik dan karier.
                </p>
                <a href="{{ route('courses') }}" class="btn btn-light btn-lg">Lihat Kursus</a>
            </div>

            <!-- Gambar -->
            <div class="col-lg-6 text-center text-lg-end">
                <img
                    src="/Image/Laptop.png"
                    alt="Hero Image"
                    class="img-fluid hero-img"
                    style="max-width: 80%; transform: translateX(1px);">
            </div>
        </div>
    </div>
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

<!-- Courses Section -->
<section class="courses py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Kursus Populer</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Course 1">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Web Development</h5>
                        <p class="card-text">Belajar HTML, CSS, JavaScript dan Framework modern.</p>
                        <p class="text-muted small">⭐ 4.8 (320 reviews)</p>
                        <a href="{{ route('courses') }}" class="btn btn-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Course 2">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Digital Marketing</h5>
                        <p class="card-text">Kuasai strategi marketing digital untuk bisnis online.</p>
                        <p class="text-muted small">⭐ 4.7 (250 reviews)</p>
                        <a href="{{ route('courses') }}" class="btn btn-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Course 3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">UI/UX Design</h5>
                        <p class="card-text">Desain interface yang menarik dan user experience terbaik.</p>
                        <p class="text-muted small">⭐ 4.9 (410 reviews)</p>
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
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                    </div>
                    <p class="mb-4">"Sriwijaya Course benar-benar mengubah cara saya belajar. Mentornya sangat responsif dan materi yang diberikan sangat relevan dengan industri. Sekarang saya sudah bisa mendapatkan pekerjaan di bidang yang saya impikan!"</p>
                    <div class="d-flex align-items-center">
                        <!-- Ade (male portrait) -->
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
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                    </div>
                    <p class="mb-4">"Saya terkesan dengan komunitas yang sangat supportif dan mentor yang berpengalaman. Tidak hanya belajar skill teknis, tapi juga soft skill yang sangat penting untuk karier. Recommended banget!"</p>
                    <div class="d-flex align-items-center">
                        <!-- Siti (female portrait) -->
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
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                    </div>
                    <p class="mb-4">"Materi terstruktur dengan baik dan cara pengajaran yang mudah dipahami. Saya dari background non-IT dan sekarang sudah bisa membuat website sendiri. Terima kasih Sriwijaya Course!"</p>
                    <div class="d-flex align-items-center">
                        <!-- Budi (male portrait) -->
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
        <a href="{{ route('courses') }}" class="btn btn-light btn-lg">Mulai Belajar Sekarang</a>
    </div>
</section>

@endsection