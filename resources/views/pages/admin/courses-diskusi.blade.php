@extends('layouts.app')
@section('title', 'Forum Diskusi - ' . $course->nama)
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem;">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Forum Diskusi - {{ $course->nama }}</h5>
                <a href="{{ route('admin.courses.detail', $course->id) }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahDiskusiModal">
                            <i class="bi bi-plus-circle"></i> Buat Diskusi Baru
                        </button>
                    </div>

                    @if($diskusiList->count() > 0)
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @foreach($diskusiList as $diskusi)
                            <div class="mb-3 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">
                                            <a href="{{ route('admin.courses.diskusi.detail', [$course->id, $diskusi->id]) }}" class="text-decoration-none">
                                                {{ $diskusi->judul }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            Oleh <strong>{{ $diskusi->pembuat->nama }}</strong>
                                            - {{ $diskusi->created_at->diffForHumans() }}
                                        </small>
                                        <p class="text-muted small mt-2 mb-0">{{ Str::limit($diskusi->konten, 100) }}</p>
                                    </div>
                                    <div>
                                        <span class="badge bg-info">{{ $diskusi->jumlah_balasan }} Balasan</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info">
                        <p class="mb-0">Belum ada diskusi. Mulai diskusi pertama Anda!</p>
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
                <h5 class="modal-title">Buat Diskusi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.courses.diskusi.store', $course->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Diskusi</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="konten" class="form-label">Pertanyaan/Diskusi</label>
                        <textarea class="form-control" id="konten" name="konten" rows="4" required></textarea>
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