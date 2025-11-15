@extends('layouts.app')

@section('title', 'Dashboard Pelajar - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-8">
                    <h1 class="fw-bold">Dashboard Pelajar</h1>
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
                            <h6 class="text-muted mb-2">Kursus Aktif</h6>
                            <h2 class="fw-bold text-primary">5</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Penyelesaian</h6>
                            <h2 class="fw-bold text-success">60%</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Nilai Rata-rata</h6>
                            <h2 class="fw-bold text-info">85</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0">Kursus Saya</h5>
                        </div>
                        <div class="card-body">
                            <div class="course-list">
                                <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">Web Development Basics</h6>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-primary" style="width: 70%"></div>
                                        </div>
                                        <small class="text-muted">70% selesai</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">PHP Advanced</h6>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 50%"></div>
                                        </div>
                                        <small class="text-muted">50% selesai</small>
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
                                <p class="fw-bold"><span class="badge bg-info">{{ ucfirst(auth()->user()->peran) }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection