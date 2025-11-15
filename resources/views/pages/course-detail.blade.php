@extends('layouts.app')

@section('title', $course->nama ?? 'Kursus' . ' - Kursus Sriwijaya')

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

@if($course)
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">{{ $course->nama }}</h1>
                <p class="lead mb-4">{{ $course->deskripsi }}</p>
                <h3 class="mb-4">Rp {{ number_format($course->harga, 0, ',', '.') }}</h3>
                <button class="btn btn-light btn-lg me-2">
                    <i class="bi bi-cart-plus"></i> Daftar Sekarang
                </button>
                <button class="btn btn-outline-light btn-lg">
                    <i class="bi bi-bookmark"></i> Simpan
                </button>
            </div>
            <div class="col-lg-6">
                @if($course->image)
                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->nama }}" class="img-fluid rounded-3 shadow-lg">
                @else
                <div class="bg-light rounded-3 shadow-lg d-flex align-items-center justify-content-center" style="height: 400px;">
                    <i class="bi bi-image text-muted" style="font-size: 100px;"></i>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Detail Section -->
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12">
            @if($course->pengajar)
            <div class="info-badge">
                <i class="bi bi-person-circle"></i>
                <strong>Instruktur:</strong> {{ $course->pengajar->nama }}
            </div>
            @endif
            <div class="info-badge">
                <i class="bi bi-clock-history"></i>
                <strong>Durasi:</strong> {{ $course->durasi_jam ?? 0 }} Jam
            </div>
            <div class="info-badge">
                <i class="bi bi-people"></i>
                <strong>Peserta:</strong> {{ $course->jumlah_pelajar ?? 0 }} Orang
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="row">
        <div class="col-lg-8">
            <h2 class="mb-4 fw-bold">
                <i class="bi bi-book"></i> Konten Kursus
            </h2>

            @if($course->konten)
            <div class="card p-4">
                <div class="card-body">
                    {!! nl2br(e($course->konten)) !!}
                </div>
            </div>
            @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Konten kursus akan ditampilkan di sini
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-body">
                    <h5 class="card-title mb-4">Ringkasan Kursus</h5>

                    <div class="mb-4">
                        <p class="text-muted mb-2">Status</p>
                        <h6>
                            @if($course->status === 'published')
                            <span class="badge bg-success">Tersedia</span>
                            @elseif($course->status === 'draft')
                            <span class="badge bg-warning">Draft</span>
                            @else
                            <span class="badge bg-danger">Archived</span>
                            @endif
                        </h6>
                    </div>

                    <div class="mb-4">
                        <p class="text-muted mb-2">Durasi Total</p>
                        <h3 class="text-primary">{{ $course->durasi_jam ?? 0 }} Jam</h3>
                    </div>

                    <div class="mb-4">
                        <p class="text-muted mb-2">Total Peserta</p>
                        <h3 class="text-primary">{{ $course->jumlah_pelajar ?? 0 }} Orang</h3>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <h5 class="mb-3">Harga</h5>
                        <h2 class="text-danger fw-bold">Rp {{ number_format($course->harga, 0, ',', '.') }}</h2>
                    </div>

                    @auth
                    @if(auth()->user()->peran === 'pelajar')
                    <form action="{{ route('student.courses.enroll', $course->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 btn-lg mb-2">
                            <i class="bi bi-check-circle"></i> Daftar Sekarang
                        </button>
                    </form>
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary w-100 btn-lg mb-2">
                        <i class="bi bi-check-circle"></i> Login untuk Daftar
                    </a>
                    @endauth

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

@else
<div class="container py-5">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i>
        <strong>Kursus tidak ditemukan!</strong> Kursus yang Anda cari tidak tersedia.
        <a href="{{ route('courses') }}" class="alert-link">Kembali ke daftar kursus</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
@endsection