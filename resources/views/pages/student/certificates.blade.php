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

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kursus</th>
                            <th>Tanggal Lulus</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Web Development Basics</td>
                            <td>15 Agustus 2024</td>
                            <td><span class="badge bg-success">A</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Unduh</button>
                                <button class="btn btn-sm btn-outline-secondary">Lihat</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>PHP Advanced</td>
                            <td>20 September 2024</td>
                            <td><span class="badge bg-success">A</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Unduh</button>
                                <button class="btn btn-sm btn-outline-secondary">Lihat</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>React JS</td>
                            <td>10 Oktober 2024</td>
                            <td><span class="badge bg-success">B+</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Unduh</button>
                                <button class="btn btn-sm btn-outline-secondary">Lihat</button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Python Data Science</td>
                            <td>05 November 2024</td>
                            <td><span class="badge bg-success">A+</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Unduh</button>
                                <button class="btn btn-sm btn-outline-secondary">Lihat</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="alert alert-info mt-4">
                <i class="fa-solid fa-info-circle me-2"></i>
                <strong>Info:</strong> Sertifikat dapat diunduh setelah Anda menyelesaikan kursus dengan nilai minimal C.
            </div>
        </div>
    </main>
</div>
@endsection