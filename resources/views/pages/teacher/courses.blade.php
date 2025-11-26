@extends('layouts.app')
@section('title', 'Entry Kursus - Pengajar')
@section('content')
<div class="d-flex">
    @include('components.sidebar-teacher')
    <main style="margin-left: 250px; padding-top: 70px;" class="flex-fill p-4">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">Entry Kursus</h5>
                <p class="text-muted small mb-0">Kelola kursus yang Anda ajarkan</p>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="row">
            @forelse($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <!-- Course Image -->
                    <div style="height:160px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); position:relative; overflow:hidden; display:flex; align-items:center; justify-content:center;">
                        @if($course->image)
                        <img src="{{ $course->image }}" alt="{{ $course->nama }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                        <i class="fa-solid fa-image text-white" style="font-size:50px; opacity:0.5;"></i>
                        @endif
                    </div>

                    <!-- Course Info -->
                    <div class="card-body pb-2">
                        <h6 class="card-title fw-bold mb-2">{{ $course->nama }}</h6>
                        <p class="small text-muted mb-2">{{ Str::limit($course->deskripsi, 80) }}</p>
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fa-solid fa-users me-1"></i>{{ $course->pelajar_count ?? 0 }} Peserta
                            </small>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="card-footer bg-white border-top d-grid gap-2">
                        <a href="{{ route('teacher.course-materials', $course->id) }}" class="btn btn-sm btn-outline-info">
                            <i class="fa-solid fa-book me-1"></i>Materi
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fa-solid fa-info-circle me-2"></i>Anda belum memiliki kursus. <a href="{{ route('admin.courses.create') }}">Buat kursus baru</a>
                </div>
            </div>
            @endforelse
        </div>
    </main>
</div>
@endsection