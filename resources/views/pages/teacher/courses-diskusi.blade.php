@extends('layouts.app')
@section('title', 'Forum Diskusi - ' . $course->nama)
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-teacher')
    <main style="flex: 1; padding: 2rem; width: 100%; margin-left: 250px; padding-top: 70px;">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Forum Diskusi - {{ $course->nama }}</h5>
                <a href="{{ route('teacher.course-materials', $course->id) }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahDiskusiModal">
                            <i class="bi bi-plus-circle"></i> Buat Topik Diskusi Baru
                        </button>
                    </div>

                    @if($diskusiList->count() > 0)
                    <div class="row">
                        @foreach($diskusiList as $diskusi)
                        <div class="col-md-6 mb-3">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="card-title mb-2">
                                        <a href="{{ route('teacher.courses.diskusi.show', [$course->id, $diskusi->id]) }}" class="text-decoration-none">
                                            {{ $diskusi->judul }}
                                        </a>
                                    </h6>
                                    <p class="text-muted small mb-2">{{ Str::limit($diskusi->konten, 80) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-person"></i> {{ $diskusi->pembuat->nama }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="bi bi-chat-dots"></i> {{ $diskusi->jumlah_balasan }} Balasan
                                        </small>
                                    </div>
                                    <small class="text-muted d-block mt-2">{{ $diskusi->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="card-footer bg-light">
                                    <a href="{{ route('teacher.courses.diskusi.show', [$course->id, $diskusi->id]) }}" class="btn btn-sm btn-outline-primary w-100">
                                        Lihat Diskusi
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="alert alert-info">
                        <p class="mb-0">Belum ada diskusi. Mulai diskusi pertama Anda dengan mengklik tombol di atas!</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Modal Tambah Diskusi -->
<div class="modal fade" id="tambahDiskusiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Topik Diskusi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('teacher.courses.diskusi.store', $course->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Diskusi</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" required>
                        @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="konten" class="form-label">Pertanyaan/Topik Diskusi</label>
                        <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="4" required></textarea>
                        @error('konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Diskusi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection