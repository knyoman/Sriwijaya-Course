@extends('layouts.app')

@section('title', 'Kursus - Kursus Sriwijaya')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">Semua Kursus Kami</h1>
    <div class="row g-4">
        @forelse($courses as $course)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ $course->image ?? 'https://via.placeholder.com/400x250' }}" class="card-img-top" alt="{{ $course->nama }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->nama }}</h5>
                    <p class="card-text">{{ Str::limit($course->deskripsi, 150) }}</p>
                    <p class="text-danger fw-bold">Rp {{ number_format($course->harga, 0, ',', '.') }}</p>
                    <p class="small text-secondary">Pengajar: <strong>{{ $course->pengajar->nama ?? '-' }}</strong></p>
                    <p class="small text-secondary">Durasi: <strong>{{ $course->durasi_jam }} jam</strong></p>
                    <a href="{{ route('course.detail', $course->slug) }}" class="btn btn-primary w-100">Daftar Sekarang</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">Tidak ada kursus yang tersedia saat ini</div>
        </div>
        @endforelse
    </div>
</div>
@endsection