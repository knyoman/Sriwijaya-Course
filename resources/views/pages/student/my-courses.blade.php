@extends('layouts.app')

@section('title', 'My Kursus - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem; padding-top: 70px;">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fw-bold">Kursus Saya</h1>
                <p class="text-muted">Daftar kursus yang sedang Anda ikuti</p>
            </div>

            @if($myCourses->isEmpty())
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Belum ada kursus!</strong> Anda belum mendaftar ke kursus manapun.
                <a href="{{ route('student.courses') }}" class="alert-link">Daftar kursus sekarang</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @else
            <div class="row">
                @foreach($myCourses as $course)
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ $course->image ?: 'https://via.placeholder.com/400x200?text=' . urlencode($course->nama) }}" class="card-img-top" alt="{{ $course->nama }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $course->nama }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($course->deskripsi, 100) }}</p>
                            <small class="text-muted d-block mb-2">Instruktur: {{ $course->pengajar->nama ?? 'N/A' }}</small>
                            <small class="text-muted d-block mb-3">Durasi: {{ $course->durasi_jam ?? 0 }} jam</small>
                            <a href="{{ route('student.course-learn', $course->id) }}" class="btn btn-sm btn-primary w-100">Lanjut Belajar</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </main>
</div>
@endsection