@extends('layouts.app')
@section('title', 'Detail Kursus - ' . ($course->nama ?? 'Kursus'))
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem;">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Detail Kursus</h5>
                <a href="{{ route('admin.courses') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm mb-4">
                        <img src="{{ $course->image ?? 'https://via.placeholder.com/600x400' }}" alt="{{ $course->nama }}" style="height:300px;object-fit:cover;">
                        <div class="card-body">
                            <h3 class="card-title">{{ $course->nama }}</h3>
                            <p class="text-danger fw-bold fs-5">Rp {{ number_format($course->harga, 0, ',', '.') }}</p>
                            <p class="card-text">{{ $course->deskripsi }}</p>

                            <div class="row mt-4">
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h5 class="text-primary">{{ $course->durasi_jam }}</h5>
                                        <small class="text-muted">Jam Pelajaran</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h5 class="text-primary">{{ $course->jumlah_pelajar }}</h5>
                                        <small class="text-muted">Peserta Terdaftar</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h5 class="text-primary">
                                            @if($course->status === 'published')
                                            <span class="badge bg-success">Published</span>
                                            @elseif($course->status === 'draft')
                                            <span class="badge bg-warning">Draft</span>
                                            @else
                                            <span class="badge bg-danger">Archived</span>
                                            @endif
                                        </h5>
                                        <small class="text-muted">Status</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h5 class="text-primary">{{ $course->created_at->format('d M Y') }}</h5>
                                        <small class="text-muted">Dibuat Tgl</small>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            @if($course->konten)
                            <h6 class="mb-3">Materi Pembelajaran:</h6>
                            <div class="alert alert-info">
                                <p class="mb-0">{{ $course->konten }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Informasi Kursus</h6>

                            <div class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block">Pengajar</small>
                                <strong>{{ $course->pengajar->nama ?? 'Tidak tersedia' }}</strong>
                            </div>

                            <div class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block">Email Pengajar</small>
                                <strong>{{ $course->pengajar->email ?? '-' }}</strong>
                            </div>

                            <div class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block">Durasi</small>
                                <strong>{{ $course->durasi_jam }} Jam</strong>
                            </div>

                            <div class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block">Harga</small>
                                <strong>Rp {{ number_format($course->harga, 0, ',', '.') }}</strong>
                            </div>

                            <div class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block">Status</small>
                                <strong>
                                    @if($course->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                    @elseif($course->status === 'draft')
                                    <span class="badge bg-warning">Draft</span>
                                    @else
                                    <span class="badge bg-danger">Archived</span>
                                    @endif
                                </strong>
                            </div>

                            <div class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block">Jumlah Pelajar</small>
                                <strong>{{ $course->jumlah_pelajar }} Pelajar</strong>
                            </div>

                            <h6 class="card-title mb-3 mt-4">Info Tambahan</h6>
                            <ul class="list-unstyled small">
                                <li class="mb-2"><i class="bi bi-calendar-event text-primary"></i> Dibuat: {{ $course->created_at->format('d M Y H:i') }}</li>
                                <li class="mb-2"><i class="bi bi-arrow-repeat text-primary"></i> Diupdate: {{ $course->updated_at->format('d M Y H:i') }}</li>
                                <li class="mb-2"><i class="bi bi-hash text-primary"></i> ID: {{ $course->id }}</li>
                            </ul>

                            <hr>

                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-primary btn-sm w-50">Edit</a>
                                <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST" style="width: 50%;" onsubmit="return confirm('Yakin ingin menghapus kursus ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if($course->pelajar->count() > 0)
                    <div class="card shadow-sm mt-3">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Daftar Pelajar ({{ $course->pelajar->count() }})</h6>
                            <div style="max-height: 300px; overflow-y: auto;">
                                <ul class="list-unstyled small">
                                    @foreach($course->pelajar as $pelajar)
                                    <li class="mb-2 pb-2 border-bottom">
                                        <strong>{{ $pelajar->nama }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $pelajar->email }}</small>
                                        <br>
                                        @php
                                        $status = $pelajar->pivot->status ?? 'terdaftar';
                                        $statusColor = match($status) {
                                        'aktif' => 'success',
                                        'selesai' => 'primary',
                                        'dibatalkan' => 'danger',
                                        default => 'warning'
                                        };
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }}">{{ ucfirst($status) }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>
@endsection