@extends('layouts.app')

@section('title', 'Belajar Kursus - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <div class="mb-4">
                <a href="{{ route('student.my-courses') }}" class="btn btn-outline-secondary btn-sm mb-3">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
                <h1 class="fw-bold">{{ $courseName ?? 'Web Development Basics' }}</h1>
                <p class="text-muted">Instruktur: Doni Santoso</p>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <!-- Video Player -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-0">
                            <div style="width: 100%; height: 400px; background: #000; display: flex; align-items: center; justify-content: center;">
                                <div class="text-center text-white">
                                    <i class="fa-solid fa-play" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                    <p>Video Pembelajaran</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0">Materi Pembelajaran</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#overview">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#materials">Materi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#discussion">Diskusi</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="overview" class="tab-pane fade show active">
                                    <h6 class="fw-bold mb-3">Deskripsi Kursus</h6>
                                    <p class="text-muted">Kursus ini dirancang untuk pemula yang ingin memulai perjalanan mereka di dunia web development. Anda akan mempelajari:</p>
                                    <ul class="text-muted">
                                        <li>Pengenalan HTML dan struktur dasar website</li>
                                        <li>Styling dengan CSS dan Responsive Design</li>
                                        <li>Interaktivitas dengan JavaScript</li>
                                        <li>Best practices dalam web development</li>
                                    </ul>
                                </div>

                                <div id="materials" class="tab-pane fade">
                                    <h6 class="fw-bold mb-3">File Materi</h6>
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fa-solid fa-file-pdf me-2 text-danger"></i>
                                                <span>Modul 1 - Pengenalan HTML.pdf</span>
                                            </div>
                                            <small class="text-muted">2.5 MB</small>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fa-solid fa-file-pdf me-2 text-danger"></i>
                                                <span>Modul 2 - CSS Styling.pdf</span>
                                            </div>
                                            <small class="text-muted">3.1 MB</small>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fa-solid fa-file-code me-2 text-primary"></i>
                                                <span>Source Code - Project.zip</span>
                                            </div>
                                            <small class="text-muted">1.8 MB</small>
                                        </a>
                                    </div>
                                </div>

                                <div id="discussion" class="tab-pane fade">
                                    <h6 class="fw-bold mb-3">Diskusi Kelas</h6>
                                    <div class="mb-4">
                                        <div class="d-flex gap-3 mb-3">
                                            <img src="https://via.placeholder.com/40" alt="User" class="rounded-circle" width="40">
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <strong>Ahmad Pratama</strong>
                                                    <small class="text-muted">2 jam yang lalu</small>
                                                </div>
                                                <p class="text-muted small mb-0">Bagaimana cara membuat responsive design yang baik?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="mb-2">
                                            <textarea class="form-control" rows="3" placeholder="Tulis pertanyaan atau komentar..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Course Progress -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0">Progress Belajar</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <small class="text-muted">Penyelesaian</small>
                                    <small class="fw-bold">70%</small>
                                </div>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-primary" style="width: 70%"></div>
                                </div>
                            </div>
                            <div class="text-center py-3">
                                <div class="fw-bold text-primary" style="font-size: 2rem;">70%</div>
                                <small class="text-muted">7 dari 10 materi selesai</small>
                            </div>
                        </div>
                    </div>

                    <!-- Chapters -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0">Daftar Materi</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" style="padding: 0.75rem 1rem;">
                                    <i class="fa-solid fa-circle-check text-success me-2"></i>
                                    <span>Pengenalan HTML</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" style="padding: 0.75rem 1rem;">
                                    <i class="fa-solid fa-circle-check text-success me-2"></i>
                                    <span>Tag dan Elemen</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" style="padding: 0.75rem 1rem;">
                                    <i class="fa-solid fa-circle-check text-success me-2"></i>
                                    <span>Pengenalan CSS</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center active" style="padding: 0.75rem 1rem;">
                                    <i class="fa-solid fa-play text-primary me-2"></i>
                                    <span>Styling & Layout</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" style="padding: 0.75rem 1rem;">
                                    <i class="fa-solid fa-circle text-muted me-2"></i>
                                    <span>Responsive Design</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" style="padding: 0.75rem 1rem;">
                                    <i class="fa-solid fa-circle text-muted me-2"></i>
                                    <span>JavaScript Dasar</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" style="padding: 0.75rem 1rem;">
                                    <i class="fa-solid fa-circle text-muted me-2"></i>
                                    <span>DOM Manipulation</span>
                                </a>
                                <a href="{{ route('student.quiz') }}" class="list-group-item list-group-item-action d-flex align-items-center" style="padding: 0.75rem 1rem;">
                                    <i class="fa-solid fa-circle text-muted me-2"></i>
                                    <span>Quiz</span>
                                </a>
                                <a href="{{ route('student.certificate') }}" class="list-group-item list-group-item-action d-flex align-items-center" style="padding: 0.75rem 1rem;">
                                    <i class="fa-solid fa-circle text-muted me-2"></i>
                                    <span>Sertifikat</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection