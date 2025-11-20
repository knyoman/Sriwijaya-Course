@extends('layouts.app')
@section('title', 'Entry Jadwal Mentoring')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <h5 class="mb-4">Entry Jadwal Mentoring</h5>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div>
                <a href="{{ route('admin.mentoring.create') }}" class="btn btn-secondary btn-sm">+ Tambah Jadwal</a>
            </div>

            <!-- Tampilan Card untuk desktop -->
            <div class="d-none d-md-block">
                <div class="row">
                    @forelse($mentorings as $mentoring)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card h-100 shadow-sm border-0 hover" style="cursor: pointer; transition: all 0.3s;">
                            <div class="card-body">
                                <!-- Status Badge -->
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="card-title mb-0">{{ $mentoring->pengajar->nama }}</h6>
                                    <span class="badge 
                                        @if($mentoring->status === 'Belum') bg-warning
                                        @elseif($mentoring->status === 'Sedang Berlangsung') bg-info
                                        @else bg-success
                                        @endif">
                                        {{ $mentoring->status }}
                                    </span>
                                </div>

                                <!-- Topik -->
                                <p class="text-muted small mb-2">{{ $mentoring->topik }}</p>

                                <!-- Kursus -->
                                @if($mentoring->kursus)
                                <p class="small text-info mb-2">
                                    <i class="fa-solid fa-book"></i>
                                    <span class="ms-2">{{ $mentoring->kursus->nama }}</span>
                                </p>
                                @endif

                                <!-- Informasi Tanggal & Waktu -->
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="small mb-2">
                                        <i class="fa-solid fa-calendar text-primary"></i>
                                        <span class="ms-2">{{ $mentoring->tanggal->locale('id')->translatedFormat('l, d F Y') }}</span>
                                    </div>
                                    <div class="small mb-2">
                                        <i class="fa-solid fa-clock text-primary"></i>
                                        <span class="ms-2">
                                            {{ $mentoring->jam }} -
                                            @if($mentoring->jam && $mentoring->durasi)
                                            {{ \Carbon\Carbon::parse($mentoring->jam)->addMinutes($mentoring->durasi)->format('H:i') }}
                                            @else
                                            -
                                            @endif
                                        </span>
                                    </div>
                                    <div class="small">
                                        <i class="fa-solid fa-hourglass-end text-primary"></i>
                                        <span class="ms-2">{{ $mentoring->durasi }} menit</span>
                                    </div>
                                </div>

                                <!-- Jumlah Peserta dari Kursus -->
                                <div class="small mb-3">
                                    <i class="fa-solid fa-users text-success"></i>
                                    <span class="ms-2">
                                        Peserta:
                                        @if($mentoring->kursus)
                                        {{ $mentoring->kursus->pelajar()->count() }}
                                        @else
                                        -
                                        @endif
                                    </span>
                                </div>

                                <!-- Aksi -->
                                <div class="d-flex gap-2 flex-wrap">
                                    @if($mentoring->zoom_link)
                                    <a href="{{ $mentoring->zoom_link }}" target="_blank" class="btn btn-info btn-sm" title="Buka Zoom">
                                        <i class="fa-solid fa-video"></i> Zoom
                                    </a>
                                    @endif
                                    <a href="{{ route('admin.mentoring.feedback', $mentoring->id) }}" class="btn btn-success btn-sm" title="Lihat Feedback">
                                        <i class="fa-solid fa-comments"></i> Feedback
                                    </a>
                                    <a href="{{ route('admin.mentoring.edit', $mentoring->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fa-solid fa-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.mentoring.destroy', $mentoring->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus jadwal ini?')" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fa-solid fa-info-circle me-2"></i>
                            Belum ada jadwal mentoring
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Tampilan Table untuk mobile -->
            <div class="d-md-none table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Pengajar</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mentorings as $mentoring)
                        <tr>
                            <td>{{ $mentoring->pengajar->nama }}</td>
                            <td>{{ $mentoring->tanggal->format('d M Y') }} {{ $mentoring->jam }}</td>
                            <td>
                                <span class="badge {{ $mentoring->status === 'Sudah' ? 'bg-success' : ($mentoring->status === 'Sedang Berlangsung' ? 'bg-info' : 'bg-warning') }}">{{ $mentoring->status }}</span>
                            </td>
                            <td>
                                @if($mentoring->zoom_link)
                                <a href="{{ $mentoring->zoom_link }}" target="_blank" class="btn btn-info btn-sm mb-1">Zoom</a>
                                @endif
                                <a href="{{ route('admin.mentoring.feedback', $mentoring->id) }}" class="btn btn-success btn-sm mb-1">Feedback</a>
                                <a href="{{ route('admin.mentoring.edit', $mentoring->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                <form action="{{ route('admin.mentoring.destroy', $mentoring->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus jadwal ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada jadwal mentoring</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection