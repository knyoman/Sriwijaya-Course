@extends('layouts.app')

@section('title', 'Semua Kursus - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fw-bold">Semua Kursus</h1>
                <p class="text-muted">Jelajahi dan daftar kursus pilihan</p>
            </div>

            <div class="row">
                @forelse($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ $course->image ?? 'https://via.placeholder.com/400x250' }}" class="card-img-top" alt="{{ $course->nama }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $course->nama }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($course->deskripsi, 100) }}</p>
                            <p class="fw-bold text-success mb-2">Rp. {{ number_format($course->harga, 0, ',', '.') }}</p>
                            <p class="small text-secondary">Pengajar: <strong>{{ $course->pengajar->nama ?? '-' }}</strong></p>
                            <p class="small text-secondary">Durasi: <strong>{{ $course->durasi_jam }} jam</strong></p>
                            <p class="small text-secondary">Peserta: <strong>{{ $course->jumlah_pelajar }} pelajar</strong></p>

                            @if(auth()->user()->enrolledCourses()->where('kursus_id', $course->id)->exists())
                            <a href="{{ route('student.course-learn', $course->id) }}" class="btn btn-primary w-100">Lanjutkan Belajar</a>
                            @else
                            <form action="{{ route('student.course.enroll', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">Tidak ada kursus yang tersedia</div>
                </div>
                @endforelse
            </div>
        </div>
    </main>
</div>
@endsection