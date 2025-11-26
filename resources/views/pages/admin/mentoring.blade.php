@extends('layouts.app')
@section('title', 'Entry Jadwal Mentoring')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem;">
        <div class="container-fluid">
            <h5 class="mb-4">Entry Jadwal Mentoring</h5>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <form method="GET" action="" class="d-flex align-items-center gap-2">
                    <label for="filter_kursus" class="form-label mb-0">Filter Kursus:</label>
                    <select name="kursus_id" id="filter_kursus" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Kursus</option>
                        @foreach($kursuses as $kursus)
                        <option value="{{ $kursus->id }}" {{ request('kursus_id') == $kursus->id ? 'selected' : '' }}>{{ $kursus->nama }}</option>
                        @endforeach
                    </select>
                </form>
                <a href="{{ route('admin.mentoring.create') }}" class="btn btn-secondary btn-sm">+ Tambah Jadwal</a>
            </div>

            <!-- Tabel Mentoring -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Kursus</th>
                            <th>Pengajar</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Peserta</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $sortedMentorings = $mentorings->sortBy(function($m) {
                        return $m->status === 'Sedang Berlangsung' ? 0 : ($m->status === 'Belum' ? 1 : 2);
                        })->values();
                        @endphp
                        @forelse($sortedMentorings as $mentoring)
                        @if(!request('kursus_id') || (request('kursus_id') && $mentoring->kursus && $mentoring->kursus->id == request('kursus_id')))
                        <tr>
                            <td>{{ $mentoring->kursus ? $mentoring->kursus->nama : '-' }}</td>
                            <td>{{ $mentoring->pengajar->nama }}</td>
                            <td>{{ $mentoring->tanggal->locale('id')->translatedFormat('l, d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $mentoring->jam)->format('H:i') ?? $mentoring->jam }}</td>
                            <td>{{ $mentoring->durasi }} menit</td>
                            <td>
                                <span class="badge @if($mentoring->status === 'Belum') bg-warning @elseif($mentoring->status === 'Sedang Berlangsung') bg-info @else bg-success @endif">
                                    {{ $mentoring->status }}
                                </span>
                            </td>
                            <td>{{ $mentoring->kursus ? $mentoring->kursus->pelajar()->count() : '-' }}</td>
                            <td class="d-flex gap-2 flex-wrap">
                                <div class="dropdown">
                                    <button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $mentoring->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-pencil"></i> Aksi
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="aksiDropdown{{ $mentoring->id }}">
                                        @if($mentoring->zoom_link)
                                        <li>
                                            <a class="dropdown-item text-info" href="{{ $mentoring->zoom_link }}" target="_blank">
                                                <i class="fa-solid fa-video"></i> Zoom
                                            </a>
                                        </li>
                                        @endif
                                        <li>
                                            <a class="dropdown-item text-success" href="{{ route('admin.mentoring.feedback', $mentoring->id) }}">
                                                <i class="fa-solid fa-comments"></i> Feedback
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-warning" href="{{ route('admin.mentoring.edit', $mentoring->id) }}">
                                                <i class="fa-solid fa-pencil"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.mentoring.destroy', $mentoring->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger d-flex align-items-center" style="gap:4px;">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada jadwal mentoring</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
                            <td>{{ $mentoring->tanggal->format('d M Y') }} {{ \Carbon\Carbon::createFromFormat('H:i:s', $mentoring->jam)->format('H:i') ?? $mentoring->jam }}</td>
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
                                    <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center" style="gap:4px;" onclick="return confirm('Hapus jadwal ini?')">
                                        <i class="fa-solid fa-trash"></i>
                                        <span>Hapus</span>
                                    </button>
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