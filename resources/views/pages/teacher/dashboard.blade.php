@extends('layouts.app')
@section('title', 'Dashboard Pengajar - Sriwijaya Course')
@section('content')
<div class="d-flex">
    @include('components.sidebar-teacher')
    <main class="flex-fill p-4">
        <div class="mb-4">
            <h5 class="text-muted mb-1">Dashboard Pengajar</h5>
            <p class="mb-0 text-muted small">Selamat datang, {{ auth()->user()->nama }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="fw-bold small text-muted mb-2">Jumlah Kursus</div>
                        <div class="display-6 fw-bold text-primary">{{ $kursusCount ?? 0 }}</div>
                        <small class="text-muted">Kursus Aktif</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="fw-bold small text-muted mb-2">Jumlah Pelajar</div>
                        <div class="display-6 fw-bold text-success">{{ $totalPelajar ?? 0 }}</div>
                        <small class="text-muted">Peserta Terdaftar</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="fw-bold small text-muted mb-2">Jadwal Mentoring</div>
                        <div class="display-6 fw-bold text-warning">{{ $mentoringUpcoming ?? 0 }}</div>
                        <small class="text-muted">Sesi Mendatang</small>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection