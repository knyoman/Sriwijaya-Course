@extends('layouts.app')

@section('title', 'Kursus - Kursus Sriwijaya')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">Semua Kursus Kami</h1>
    <div class="row g-4">
        @forelse($courses as $course)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ $course->image ?: 'https://via.placeholder.com/400x250?text=' . urlencode($course->nama) }}" class="card-img-top" alt="{{ $course->nama }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->nama }}</h5>
                    <p class="card-text">{{ Str::limit($course->deskripsi, 150) }}</p>
                    <p class="text-danger fw-bold">Rp {{ number_format($course->harga, 0, ',', '.') }}</p>
                    <p class="small text-secondary">Pengajar: <strong>{{ $course->pengajar->nama ?? '-' }}</strong></p>
                    <p class="small text-secondary">Durasi: <strong>{{ $course->durasi_jam }} jam</strong></p>

                    @auth
                    @if(auth()->user()->peran === 'pelajar')
                    @if(auth()->user()->enrolledCourses()->where('kursus_id', $course->id)->exists())
                    <a href="{{ route('student.course-learn', $course->id) }}" class="btn btn-success w-100">Lanjutkan Belajar</a>
                    @else
                    <form action="{{ route('student.course.enroll', $course->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                    </form>
                    @endif
                    @else
                    <a href="{{ route('course.detail', $course->slug) }}" class="btn btn-primary w-100">Lihat Detail</a>
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary w-100">Daftar Sekarang</a>
                    @endauth
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