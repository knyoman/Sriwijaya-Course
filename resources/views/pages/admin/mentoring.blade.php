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

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Pengajar</th>
                            <th>Tanggal Mentoring</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $mentorings = [
                        [
                        'id' => 1,
                        'pengajar' => 'Ahmad Sugiarto',
                        'tanggal' => '2025-12-01',
                        'jam' => '09:00',
                        'status' => 'Belum',
                        'zoom_link' => 'https://zoom.us/j/1234567890'
                        ],
                        [
                        'id' => 2,
                        'pengajar' => 'Siti Nurhaliza',
                        'tanggal' => '2025-12-02',
                        'jam' => '10:00',
                        'status' => 'Belum',
                        'zoom_link' => 'https://zoom.us/j/1234567891'
                        ],
                        [
                        'id' => 3,
                        'pengajar' => 'Budi Santoso',
                        'tanggal' => '2025-12-03',
                        'jam' => '14:00',
                        'status' => 'Belum',
                        'zoom_link' => 'https://zoom.us/j/1234567892'
                        ],
                        [
                        'id' => 4,
                        'pengajar' => 'Rina Wijaya',
                        'tanggal' => '2025-12-04',
                        'jam' => '15:00',
                        'status' => 'Sudah',
                        'zoom_link' => 'https://zoom.us/j/1234567893'
                        ],
                        [
                        'id' => 5,
                        'pengajar' => 'Hendra Kusuma',
                        'tanggal' => '2025-12-05',
                        'jam' => '09:30',
                        'status' => 'Sudah',
                        'zoom_link' => 'https://zoom.us/j/1234567894'
                        ],
                        [
                        'id' => 6,
                        'pengajar' => 'Tika Maharani',
                        'tanggal' => '2025-12-06',
                        'jam' => '11:00',
                        'status' => 'Sudah',
                        'zoom_link' => 'https://zoom.us/j/1234567895'
                        ],
                        [
                        'id' => 7,
                        'pengajar' => 'Reza Pratama',
                        'tanggal' => '2025-12-07',
                        'jam' => '13:00',
                        'status' => 'Sudah',
                        'zoom_link' => 'https://zoom.us/j/1234567896'
                        ],
                        [
                        'id' => 8,
                        'pengajar' => 'Dewi Lestari',
                        'tanggal' => '2025-12-08',
                        'jam' => '16:00',
                        'status' => 'Sudah',
                        'zoom_link' => 'https://zoom.us/j/1234567897'
                        ],
                        [
                        'id' => 9,
                        'pengajar' => 'Farhan Maulana',
                        'tanggal' => '2025-12-09',
                        'jam' => '10:30',
                        'status' => 'Sudah',
                        'zoom_link' => 'https://zoom.us/j/1234567898'
                        ]
                        ];
                        @endphp

                        @foreach($mentorings as $mentoring)
                        <tr>
                            <td>{{ $mentoring['pengajar'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($mentoring['tanggal'])->format('d M Y') }} {{ $mentoring['jam'] }}</td>
                            <td>
                                <span class="badge {{ $mentoring['status'] === 'Sudah' ? 'bg-success' : 'bg-warning' }}">{{ $mentoring['status'] }}</span>
                            </td>
                            <td>
                                <a href="{{ $mentoring['zoom_link'] }}" target="_blank" class="btn btn-info btn-sm me-2">Link Zoom</a>
                                <a href="{{ route('admin.mentoring.edit', $mentoring['id']) }}" class="btn btn-secondary btn-sm me-2">Edit</a>
                                <a href="{{ route('admin.mentoring.delete', $mentoring['id']) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus jadwal ini?')">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection