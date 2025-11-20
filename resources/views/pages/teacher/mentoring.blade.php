@extends('layouts.app')
@section('title', 'Jadwal Mentoring - Pengajar')
@section('content')
<div class="d-flex">
    @include('components.sidebar-teacher')
    <main class="flex-fill p-4">
        <div class="mb-4">
            <h5 class="mb-1">Jadwal Mentoring</h5>
            <p class="text-muted small mb-0">Kelola sesi mentoring dengan peserta</p>
        </div>

        <!-- Schedule Table -->
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal & Waktu</th>
                            <th>Peserta</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mentorings as $mentoring)
                        <tr>
                            <td>
                                <i class="fa-solid fa-calendar me-2"></i>
                                {{ $mentoring->tanggal->format('d M Y') }} - {{ $mentoring->jam }}
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    @if($mentoring->kursus)
                                    Peserta: {{ $mentoring->kursus->pelajar()->count() }}
                                    @else
                                    Peserta: 0
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $mentoring->status === 'Sudah' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $mentoring->status === 'Sudah' ? 'Selesai' : 'Akan Datang' }}
                                </span>
                            </td>
                            <td>
                                @if($mentoring->zoom_link)
                                <a href="{{ $mentoring->zoom_link }}" class="btn btn-sm btn-primary" target="_blank">
                                    <i class="fa-solid fa-video me-1"></i>Bergabung
                                </a>
                                @else
                                <span class="text-muted small">Belum ada link</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada jadwal mentoring</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

@endsection