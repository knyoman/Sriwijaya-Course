@extends('layouts.app')

@section('title', 'Dashboard Pelajar - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem; padding-top: 70px;">
        <div class="container-fluid">
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <h1 class="fw-bold mb-1">
                        <i class="fas fa-th-large me-2" style="color: #2563eb;"></i>Dashboard Pelajar
                    </h1>
                    <p class="text-muted">Selamat datang, {{ auth()->user()->nama }}!</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100" style="transition: transform 0.3s ease;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-2">
                                        <i class="fas fa-book me-2"></i>Kursus Aktif
                                    </h6>
                                    <h2 class="fw-bold text-primary">{{ $totalKursusAktif }}</h2>
                                    <small class="text-muted">Kursus yang sedang diikuti</small>
                                </div>
                                <div style="font-size: 2rem; color: #dbeafe;">
                                    <i class="fas fa-book-open"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100" style="transition: transform 0.3s ease;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-2">
                                        <i class="fas fa-certificate me-2"></i>Sertifikat
                                    </h6>
                                    <h2 class="fw-bold text-success">{{ $totalSertifikat }}</h2>
                                    <small class="text-muted">Sertifikat yang diperoleh</small>
                                </div>
                                <div style="font-size: 2rem; color: #dcfce7;">
                                    <i class="fas fa-award"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100" style="transition: transform 0.3s ease;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-muted mb-2">
                                        <i class="fas fa-check-circle me-2"></i>Kelas Terselesaikan
                                    </h6>
                                    <h2 class="fw-bold text-info">{{ $kelasSelesai }}</h2>
                                    <small class="text-muted">Kursus yang telah diselesaikan</small>
                                </div>
                                <div style="font-size: 2rem; color: #cffafe;">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
                            <i class="fas fa-book me-2" style="color: #2563eb; font-size: 1.2em;"></i>
                            <h5 class="fw-bold mb-0">Kursus Aktif Saya</h5>
                        </div>
                        <div class="card-body">
                            @if($kursusAktif->count() > 0)
                            <div class="course-list">
                                @foreach($kursusAktif as $index => $kursus)
                                <div class="d-flex align-items-center {{ $index < $kursusAktif->count() - 1 ? 'mb-3 pb-3 border-bottom' : 'mb-3' }}">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="fw-bold mb-0">{{ $kursus->nama }}</h6>
                                            <small class="badge bg-primary">{{ $kursus->materi->count() }} Materi</small>
                                        </div>
                                        <p class="text-muted small mb-2">{{ Str::limit($kursus->deskripsi, 100) }}</p>
                                        <!-- Progress and status removed per request -->
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center py-5">
                                <i class="fas fa-inbox" style="font-size: 3rem; color: #d1d5db;"></i>
                                <p class="text-muted mt-3">Anda belum mendaftar ke kursus apapun</p>
                                <a href="{{ route('student.courses') }}" class="btn btn-primary btn-sm mt-2">
                                    <i class="fas fa-search me-1"></i>Cari Kursus
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
                            <i class="fas fa-quick-stats me-2" style="color: #2563eb; font-size: 1.2em;"></i>
                            <h5 class="fw-bold mb-0">Ringkasan</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">Total Kursus</small>
                                    <strong>{{ $totalKursusAktif }}</strong>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">Sertifikat</small>
                                    <strong>{{ $totalSertifikat }}</strong>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">Selesai</small>
                                    <strong>{{ $kelasSelesai }}</strong>
                                </div>
                            </div>
                            <hr>
                            <a href="{{ route('student.courses') }}" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-plus me-1"></i>Daftar Kursus Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
    .card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .card-header {
        border-bottom: 2px solid #f3f4f6;
    }

    .course-list .d-flex:hover {
        background-color: #f9fafb;
        border-radius: 8px;
        padding: 8px;
        margin: -8px;
    }

    .progress-bar {
        transition: width 0.6s ease;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.65rem;
    }

    main {
        background-color: transparent;
        min-height: unset;
    }

    .btn-primary {
        background-color: #2563eb;
        border: none;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }

    .btn-outline-primary {
        color: #2563eb;
        border-color: #2563eb;
        border-radius: 8px;
    }

    .btn-outline-primary:hover {
        background-color: #2563eb;
        border-color: #2563eb;
    }
</style>
@endsection