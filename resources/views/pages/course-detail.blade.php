@extends('layouts.app')

@section('title', $course['name'] . ' - Kursus Sriwijaya')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 60px 0;
    }

    .chapter-item {
        background: #f8f9fa;
        border-left: 4px solid #667eea;
        transition: all 0.3s ease;
    }

    .chapter-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .lesson-count {
        background: #667eea;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: bold;
    }

    .info-badge {
        display: inline-block;
        background: #f8f9fa;
        padding: 10px 20px;
        border-radius: 5px;
        margin-right: 15px;
        margin-bottom: 10px;
    }

    .info-badge i {
        color: #667eea;
        margin-right: 8px;
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">{{ $course['name'] }}</h1>
                <p class="lead mb-4">{{ $course['description'] }}</p>
                <h3 class="mb-4">{{ $course['price'] }}</h3>
                <button class="btn btn-light btn-lg me-2">
                    <i class="bi bi-cart-plus"></i> Daftar Sekarang
                </button>
                <button class="btn btn-outline-light btn-lg">
                    <i class="bi bi-bookmark"></i> Simpan
                </button>
            </div>
            <div class="col-lg-6">
                <img src="{{ $course['image'] }}" alt="{{ $course['name'] }}" class="img-fluid rounded-3 shadow-lg">
            </div>
        </div>
    </div>
</div>

<!-- Detail Section -->
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12">
            <div class="info-badge">
                <i class="bi bi-person-circle"></i>
                <strong>Instruktur:</strong> {{ $course['instructor'] }}
            </div>
            <div class="info-badge">
                <i class="bi bi-clock-history"></i>
                <strong>Durasi:</strong> {{ $course['duration'] }}
            </div>
            <div class="info-badge">
                <i class="bi bi-bar-chart"></i>
                <strong>Level:</strong> {{ $course['level'] }}
            </div>
        </div>
    </div>

    <!-- Chapter Section -->
    <div class="row">
        <div class="col-lg-8">
            <h2 class="mb-4 fw-bold">
                <i class="bi bi-book"></i> Materi Pembelajaran
            </h2>

            <div class="accordion" id="chapterAccordion">
                @foreach($course['chapters'] as $index => $chapter)
                <div class="accordion-item mb-3 chapter-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#chapter{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                            <span class="fw-bold flex-grow-1">{{ $index + 1 }}. {{ $chapter['title'] }}</span>
                            <span class="lesson-count ms-auto">{{ $chapter['lessons'] }} Pelajaran</span>
                        </button>
                    </h2>
                    <div id="chapter{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                        data-bs-parent="#chapterAccordion">
                        <div class="accordion-body">
                            @for($i = 1; $i <= $chapter['lessons']; $i++)
                                <div class="d-flex align-items-center py-2 border-bottom">
                                <i class="bi bi-play-circle text-primary me-3"></i>
                                <span>Lesson {{ $i }}: {{ $chapter['title'] }} - Part {{ $i }}</span>
                                <span class="badge bg-secondary ms-auto">25 min</span>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <div class="card shadow-sm sticky-top" style="top: 20px;">
            <div class="card-body">
                <h5 class="card-title mb-4">Ringkasan Kursus</h5>

                <div class="mb-4">
                    <p class="text-muted mb-2">Total Chapter</p>
                    <h3 class="text-primary">{{ count($course['chapters']) }}</h3>
                </div>

                <div class="mb-4">
                    <p class="text-muted mb-2">Total Lessons</p>
                    <h3 class="text-primary">{{ array_sum(array_column($course['chapters'], 'lessons')) }}</h3>
                </div>

                <div class="mb-4">
                    <p class="text-muted mb-2">Durasi Total</p>
                    <h3 class="text-primary">{{ $course['duration'] }}</h3>
                </div>

                <hr>

                <div class="mb-4">
                    <h5 class="mb-3">Harga</h5>
                    <h2 class="text-danger fw-bold">{{ $course['price'] }}</h2>
                </div>

                <button class="btn btn-primary w-100 btn-lg mb-2">
                    <i class="bi bi-check-circle"></i> Daftar Sekarang
                </button>
                <button class="btn btn-outline-secondary w-100">
                    <i class="bi bi-bookmark"></i> Simpan untuk Nanti
                </button>

                <hr>

                <div class="mt-4">
                    <h6 class="mb-3">Fitur Kursus:</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success"></i> Akses Seumur Hidup
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success"></i> Sertifikat Resmi
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success"></i> Dukungan Instruktur
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success"></i> Materi Downloadable
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success"></i> Komunitas Belajar
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Back Button -->
<div class="container py-4">
    <a href="{{ route('courses') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Kursus
    </a>
</div>
@endsection