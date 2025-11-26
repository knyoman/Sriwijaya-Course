@extends('layouts.app')

@section('title', 'Dashboard Admin - Kursus Sriwijaya')

@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem;">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-12">
                    <h1 class="fw-bold">Dashboard Admin</h1>
                    <p class="text-muted">Selamat datang, {{ auth()->user()->nama }}!</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Total Pengguna</h6>
                            <h2 class="fw-bold text-primary">{{ $totalUsers ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Total Kursus</h6>
                            <h2 class="fw-bold text-success">{{ $totalKursus ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Pengajar</h6>
                            <h2 class="fw-bold text-info">{{ $pengajarCount ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Pelajar</h6>
                            <h2 class="fw-bold text-warning">{{ $pelajarCount ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content: intentionally left empty -->
            <div class="row">
                <div class="col-12">
                    <!-- kosong -->
                </div>
            </div>
        </div>
    </main>
</div>
@endsection