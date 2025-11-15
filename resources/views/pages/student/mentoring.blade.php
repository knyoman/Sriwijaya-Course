@extends('layouts.app')

@section('title', 'Jadwal Mentoring - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fw-bold">Jadwal Mentoring</h1>
                <p class="text-muted">Daftar sesi mentoring yang telah Anda daftarkan</p>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Pengajar</th>
                            <th>Tanggal & Waktu</th>
                            <th>Topik</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Doni Santoso</td>
                            <td>20 Nov 2024 - 10:00</td>
                            <td>HTML & CSS Dasar</td>
                            <td><span class="badge bg-success">Sudah</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#zoomModal">
                                    <i class="fa-solid fa-video me-1"></i> Zoom
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Budi Santoso</td>
                            <td>22 Nov 2024 - 14:00</td>
                            <td>PHP OOP</td>
                            <td><span class="badge bg-warning text-dark">Belum</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#zoomModal">
                                    <i class="fa-solid fa-video me-1"></i> Zoom
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Rina Wijaya</td>
                            <td>24 Nov 2024 - 15:30</td>
                            <td>React Hooks</td>
                            <td><span class="badge bg-warning text-dark">Belum</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#zoomModal">
                                    <i class="fa-solid fa-video me-1"></i> Zoom
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Ahmad Pratama</td>
                            <td>26 Nov 2024 - 16:00</td>
                            <td>Pandas & NumPy</td>
                            <td><span class="badge bg-warning text-dark">Belum</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#zoomModal">
                                    <i class="fa-solid fa-video me-1"></i> Zoom
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Sinta Kusuma</td>
                            <td>28 Nov 2024 - 13:00</td>
                            <td>Laravel Routing</td>
                            <td><span class="badge bg-warning text-dark">Belum</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#zoomModal">
                                    <i class="fa-solid fa-video me-1"></i> Zoom
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Zoom Modal -->
<div class="modal fade" id="zoomModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Zoom Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Klik link di bawah untuk bergabung dengan sesi Zoom:</p>
                <a href="https://zoom.us/j/123456789" target="_blank" class="btn btn-primary w-100">
                    <i class="fa-solid fa-link me-2"></i> Buka Zoom Meeting
                </a>
            </div>
        </div>
    </div>
</div>
@endsection