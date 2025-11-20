@extends('layouts.app')

@section('title', 'Sertifikat - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fw-bold">Sertifikat Saya</h1>
                <p class="text-muted">Daftar sertifikat yang telah Anda raih</p>
            </div>

            @if($certificates->isEmpty())
            <div class="alert alert-warning">
                <i class="fa-solid fa-exclamation-triangle me-2"></i>
                <strong>Belum ada sertifikat.</strong> Selesaikan kursus dan lulus quiz untuk mendapatkan sertifikat.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kursus</th>
                            <th>Tanggal Lulus</th>
                            <th>Nilai</th>
                            <th>No. Sertifikat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($certificates as $certificate)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $certificate->nama_kursus }}</td>
                            <td>{{ $certificate->tanggal_cetak->locale('id')->translatedFormat('d F Y') }}</td>
                            <td><span class="badge bg-success">{{ $certificate->nilai }}/100</span></td>
                            <td><small>{{ $certificate->nomor_sertifikat }}</small></td>
                            <td>
                                <a href="{{ route('student.certificate.show', $certificate->id) }}?auto_download=1" class="btn btn-sm btn-primary" title="Download Gambar">
                                    <i class="fa-solid fa-download me-1"></i> Unduh
                                </a>
                                <a href="{{ route('student.certificate.show', $certificate->id) }}" class="btn btn-sm btn-outline-secondary" title="Lihat Sertifikat">
                                    <i class="fa-solid fa-eye me-1"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Tidak ada sertifikat</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif

            <div class="alert alert-info mt-4">
                <i class="fa-solid fa-info-circle me-2"></i>
                <strong>Info:</strong> Sertifikat dapat dicetak setelah Anda menyelesaikan kursus dengan nilai minimal 70.
            </div>
        </div>
    </main>
</div>
@endsection