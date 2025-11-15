@extends('layouts.app')

@section('title', 'Sertifikat - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <a href="{{ route('student.course-learn', 1) }}" class="btn btn-outline-secondary btn-sm mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center;">
                            <h1 class="fw-bold mb-3">SERTIFIKAT</h1>
                            <p class="fs-5 mb-4">Penghargaan atas Pencapaian Akademik</p>

                            <div class="my-5 py-5 border-top border-bottom border-light" style="border-width: 2px !important;">
                                <p class="mb-2">Dengan bangga mempersembahkan kepada</p>
                                <h2 class="fw-bold mb-3">{{ auth()->user()->nama }}</h2>
                                <p class="fs-6">Telah berhasil menyelesaikan</p>
                                <h3 class="fw-bold mb-4">Web Development Basics</h3>
                                <p class="fs-6">Dengan nilai: <strong>85/100</strong></p>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <p class="small mb-1">Jakarta, 15 November 2024</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="small mb-1">No. Sertifikat: CERT-2024-001</p>
                                </div>
                            </div>

                            <p class="small mt-4 mb-0" style="opacity: 0.9;">Sertifikat ini menyatakan bahwa pemegang telah memenuhi semua persyaratan untuk menyelesaikan kursus ini.</p>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary me-2" onclick="window.print()">
                            <i class="fa-solid fa-print me-2"></i> Cetak
                        </button>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fa-solid fa-download me-2"></i> Unduh PDF
                        </a>
                    </div>

                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0">Detail Sertifikat</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <small class="text-muted">Nama Peserta</small>
                                    <p class="fw-bold">{{ auth()->user()->nama }}</p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted">Kursus</small>
                                    <p class="fw-bold">Web Development Basics</p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted">Tanggal Lulus</small>
                                    <p class="fw-bold">15 November 2024</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <small class="text-muted">Nilai</small>
                                    <p class="fw-bold">85/100</p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted">Grade</small>
                                    <p class="fw-bold"><span class="badge bg-success">A</span></p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted">No. Sertifikat</small>
                                    <p class="fw-bold">CERT-2024-001</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <small class="text-muted">Deskripsi</small>
                                    <p class="text-muted">Sertifikat ini menunjukkan bahwa pemegang telah berhasil menyelesaikan kursus Web Development Basics dan menguasai kompetensi yang diajarkan dalam kursus ini.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4">
                        <i class="fa-solid fa-info-circle me-2"></i>
                        <strong>Info:</strong> Sertifikat ini dapat dibagikan di media sosial atau CV Anda untuk menunjukkan pencapaian akademik Anda.
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection