@extends('layouts.app')

@section('title', 'Hasil Quiz - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body py-5">
                            <div class="mb-4">
                                <i class="fa-solid fa-circle-check text-success" style="font-size: 4rem;"></i>
                            </div>
                            <h3 class="fw-bold mb-2">Quiz Selesai!</h3>
                            <p class="text-muted mb-4">Web Development Basics</p>

                            <div class="bg-light p-4 rounded mb-4">
                                <h1 class="fw-bold text-primary mb-2">85/100</h1>
                                <p class="text-muted mb-0">Nilai Anda</p>
                            </div>

                            <div class="row text-center mb-4">
                                <div class="col-md-6">
                                    <div class="p-3">
                                        <h6 class="text-muted mb-1">Jawaban Benar</h6>
                                        <h5 class="fw-bold text-success">8/10</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3">
                                        <h6 class="text-muted mb-1">Jawaban Salah</h6>
                                        <h5 class="fw-bold text-danger">2/10</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-success mb-4">
                                <i class="fa-solid fa-check-circle me-2"></i>
                                <strong>Selamat!</strong> Anda telah lulus quiz dengan nilai yang memuaskan.
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('student.course-learn', 1) }}" class="btn btn-outline-secondary flex-grow-1">
                                    Kembali ke Kursus
                                </a>
                                <a href="{{ route('student.certificate') }}" class="btn btn-primary flex-grow-1">
                                    Lihat Sertifikat
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0">Review Jawaban</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold mb-0">Soal 1: Apa singkatan dari HTML?</h6>
                                    <span class="badge bg-success">Benar</span>
                                </div>
                                <small class="text-muted">Jawaban Anda: HyperText Markup Language</small>
                            </div>

                            <div class="mb-3 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold mb-0">Soal 2: Tag HTML untuk paragraph?</h6>
                                    <span class="badge bg-success">Benar</span>
                                </div>
                                <small class="text-muted">Jawaban Anda: &lt;p&gt;</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold mb-0">Soal 3: Apa fungsi CSS?</h6>
                                <span class="badge bg-danger">Salah</span>
                            </div>
                            <div class="mb-0">
                                <small class="text-muted d-block">Jawaban Anda: Untuk membuat struktur halaman</small>
                                <small class="text-success d-block">Jawaban Benar: Untuk styling dan tampilan halaman</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection