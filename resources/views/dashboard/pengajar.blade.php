@extends('layouts.app')

@section('title', 'Dashboard Pengajar - Kursus Sriwijaya')

@section('content')
<div class="container py-5" style="margin-left: 250px; padding-top: 70px;">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="fw-bold">Dashboard Pengajar</h1>
            <p class="text-muted">Selamat datang, {{ auth()->user()->nama }}!</p>
        </div>
        <div class="col-md-4 text-end">
            <img src="https://via.placeholder.com/100" alt="Avatar" class="rounded-circle" width="80">
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Kursus Mengajar</h6>
                    <h2 class="fw-bold text-primary">3</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Pelajar</h6>
                    <h2 class="fw-bold text-success">45</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Tugas Menunggu</h6>
                    <h2 class="fw-bold text-warning">8</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Kursus Saya</h5>
                        <a href="#" class="btn btn-sm btn-primary">+ Tambah Kursus</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="course-list">
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                            <div>
                                <h6 class="fw-bold mb-1">Web Development Basics</h6>
                                <small class="text-muted">45 pelajar terdaftar</small>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-outline-primary">Kelola</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                            <div>
                                <h6 class="fw-bold mb-1">PHP Advanced</h6>
                                <small class="text-muted">30 pelajar terdaftar</small>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-outline-primary">Kelola</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">Profil Saya</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Nama</small>
                        <p class="fw-bold">{{ auth()->user()->nama }}</p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Email</small>
                        <p class="fw-bold">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Peran</small>
                        <p class="fw-bold"><span class="badge bg-success">{{ ucfirst(auth()->user()->peran) }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection