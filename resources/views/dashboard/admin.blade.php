@extends('layouts.app')

@section('title', 'Dashboard Admin - Kursus Sriwijaya')

@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
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
                            <h2 class="fw-bold text-primary">128</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Total Kursus</h6>
                            <h2 class="fw-bold text-success">15</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Pengajar</h6>
                            <h2 class="fw-bold text-info">8</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Pelajar</h6>
                            <h2 class="fw-bold text-warning">100</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">Kelola Kursus</h5>
                                <a href="#" class="btn btn-sm btn-primary">+ Tambah Kursus</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Kursus</th>
                                        <th>Pengajar</th>
                                        <th>Pelajar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Web Development Basics</td>
                                        <td>Ahmad Sugiarto</td>
                                        <td>45</td>
                                        <td>
                                            <a href="#" class="btn btn-xs btn-outline-primary">Edit</a>
                                            <a href="#" class="btn btn-xs btn-outline-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PHP Advanced</td>
                                        <td>Siti Nurhaliza</td>
                                        <td>30</td>
                                        <td>
                                            <a href="#" class="btn btn-xs btn-outline-primary">Edit</a>
                                            <a href="#" class="btn btn-xs btn-outline-danger">Hapus</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0">Profil Admin</h5>
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
                                <p class="fw-bold"><span class="badge bg-danger">{{ ucfirst(auth()->user()->peran) }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection