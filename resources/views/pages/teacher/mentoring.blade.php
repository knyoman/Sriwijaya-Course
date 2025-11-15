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
                            <th>Kursus</th>
                            <th>Tanggal & Waktu</th>
                            <th>Peserta</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $courses = [
                        'Web Development Basics',
                        'PHP Advanced',
                        'React Fundamentals',
                        'Database Design',
                        'API Development'
                        ];
                        @endphp
                        @for($i=1; $i<=5; $i++)
                            <tr>
                            <td class="fw-bold">{{ $courses[$i-1] }}</td>
                            <td>
                                <i class="fa-solid fa-calendar me-2"></i>
                                {{ now()->addDays($i)->format('d M Y') }} - 14:00
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">{{ 5 + $i }} orang</span>
                            </td>
                            <td>
                                @if($i % 2 == 0)
                                <span class="badge bg-warning">Akan Datang</span>
                                @else
                                <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                <a href="https://zoom.us/meeting" class="btn btn-sm btn-primary" target="_blank">
                                    <i class="fa-solid fa-video me-1"></i>Bergabung
                                </a>
                            </td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

@endsection