@extends('layouts.app')

@section('title', 'Semua Kursus - Kursus Sriwijaya')

@section('content')
{{-- Memuat Bootstrap Icons secara manual untuk memastikan ikon tampil --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@include('components.navbar-student')

<div class="d-flex">
    @include('components.sidebar-student')

    <main style="flex: 1; margin-left: 250px; padding: 2rem; padding-top: 90px; background-color: #f8f9fa;">
        <div class="container-fluid">
            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">Semua Kursus</h2>
                    <p class="text-muted mb-0">Tingkatkan skill Anda dengan kursus pilihan terbaik.</p>
                </div>
            </div>

            {{-- Course Grid --}}
            <div class="row g-3">
                @forelse($courses as $course)

                {{-- Cek status pendaftaran sekali di sini untuk dipakai di harga dan tombol --}}
                @php
                $isEnrolled = auth()->user()->enrolledCourses()->where('kursus_id', $course->id)->exists();
                @endphp

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden transition-hover">

                        {{-- Bagian Gambar: Aspect Ratio 16:9 --}}
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

                        {{-- Card Body --}}
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

                            {{-- Footer Card: Harga & Tombol --}}
                            <div class="mt-auto d-flex align-items-center justify-content-between">
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Harga</small>

                                    {{-- Logika Warna Harga: Biru (Primary) jika belum daftar, Hijau (Success) jika sudah --}}
                                    <span class="fw-bold {{ $isEnrolled ? 'text-success' : 'text-primary' }} fs-5">
                                        Rp {{ number_format($course->harga, 0, ',', '.') }}
                                    </span>
                                </div>

                                {{-- Logika Tombol --}}
                                @if($isEnrolled)
                                <a href="{{ route('student.course-learn', $course->id) }}" class="btn btn-outline-success rounded-pill fw-bold px-3 py-1 btn-sm">
                                    Lanjut
                                </a>
                                @else
                                <a href="{{ route('student.course.enroll', $course->id) }}" class="btn btn-primary rounded-pill fw-bold px-3 py-1 btn-sm shadow-sm">
                                    Daftar
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" alt="Empty" style="width: 150px; opacity: 0.5;">
                        <h4 class="mt-3 text-muted fw-bold">Belum ada kursus tersedia</h4>
                        <p class="text-secondary">Silakan cek kembali nanti untuk materi pembelajaran terbaru.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </main>
</div>

{{-- CSS Tambahan --}}
<style>
    .transition-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .transition-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1) !important;
    }
</style>

@endsection