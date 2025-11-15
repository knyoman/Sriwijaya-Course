@extends('layouts.app')
@section('title', 'Entry Kursus')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <h5 class="mb-3">Entry Kursus</h5>
            <div class="mb-3">
                <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Tambah Kursus Baru</a>
            </div>

            <div class="row">
                @forelse($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="{{ $course->image ?? 'https://via.placeholder.com/400x160' }}" alt="{{ $course->nama }}" style="height:160px;object-fit:cover;">
                        <div class="card-body">
                            <h6 class="card-title">{{ $course->nama }}</h6>
                            <p class="small text-muted mb-2">{{ Str::limit($course->deskripsi, 100) }}</p>
                            <p class="text-danger fw-bold">Rp {{ number_format($course->harga, 0, ',', '.') }}</p>
                            <p class="small text-secondary">Pengajar: <strong>{{ $course->pengajar->nama ?? '-' }}</strong></p>
                            <p class="small text-secondary">Status:
                                <span class="badge 
                                    {{ $course->status === 'published' ? 'bg-success' : ($course->status === 'draft' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between gap-2">
                            <a href="{{ route('admin.courses.detail', $course->id) }}" class="btn btn-outline-primary btn-sm flex-grow-1">Detail</a>
                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-outline-warning btn-sm flex-grow-1">Edit</a>
                            <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus kursus ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">Tidak ada kursus. <a href="{{ route('admin.courses.create') }}">Buat kursus baru</a></div>
                </div>
                @endforelse
            </div>
        </div>
    </main>
</div>
@endsection