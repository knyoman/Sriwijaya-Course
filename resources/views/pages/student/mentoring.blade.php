@extends('layouts.app')

@section('title', 'Jadwal Mentoring - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fw-bold">Jadwal Mentoring</h1>
                <p class="text-muted">Daftar sesi mentoring yang telah Anda daftarkan</p>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Pengajar</th>
                            <th>Tanggal & Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mentorings as $key => $mentoring)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $mentoring->pengajar->nama }}</td>
                            <td>{{ $mentoring->tanggal->format('d M Y') }} - {{ $mentoring->jam }}</td>
                            <td><span class="badge {{ $mentoring->status === 'Sudah' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $mentoring->status }}</span></td>
                            <td>
                                @if($mentoring->zoom_link)
                                <a href="{{ $mentoring->zoom_link }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-video me-1"></i> Zoom
                                </a>
                                @else
                                <span class="text-muted small">Belum ada link</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada jadwal mentoring</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection