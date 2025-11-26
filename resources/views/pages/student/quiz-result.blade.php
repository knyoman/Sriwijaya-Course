@extends('layouts.app')

@section('title', 'Hasil Quiz - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem; padding-top: 70px;">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body py-5">
                            <div class="mb-4">
                                @if(session('quiz_result.lulus'))
                                <i class="fa-solid fa-circle-check text-success" style="font-size: 4rem;"></i>
                                @else
                                <i class="fa-solid fa-circle-xmark text-danger" style="font-size: 4rem;"></i>
                                @endif
                            </div>
                            <h3 class="fw-bold mb-2">Quiz Selesai!</h3>
                            <p class="text-muted mb-4">{{ session('quiz_result.nama_quiz', 'Quiz') }}</p>

                            <div class="bg-light p-4 rounded mb-4">
                                <h1 class="fw-bold text-primary mb-2">{{ session('quiz_result.nilai', 0) }}/100</h1>
                                <p class="text-muted mb-0">Nilai Anda</p>
                            </div>

                            <div class="row text-center mb-4">
                                <div class="col-md-6">
                                    <div class="p-3">
                                        <h6 class="text-muted mb-1">Jawaban Benar</h6>
                                        <h5 class="fw-bold text-success">{{ session('quiz_result.benar', 0) }}/{{ session('quiz_result.total', 0) }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3">
                                        <h6 class="text-muted mb-1">Jawaban Salah</h6>
                                        <h5 class="fw-bold text-danger">{{ session('quiz_result.total', 0) - session('quiz_result.benar', 0) }}/{{ session('quiz_result.total', 0) }}</h5>
                                    </div>
                                </div>
                            </div>

                            @if(session('quiz_result.lulus'))
                            <div class="alert alert-success mb-4">
                                <i class="fa-solid fa-check-circle me-2"></i>
                                <strong>Selamat!</strong> Anda telah lulus quiz dengan nilai yang memuaskan.
                            </div>
                            @else
                            <div class="alert alert-warning mb-4">
                                <i class="fa-solid fa-exclamation-triangle me-2"></i>
                                <strong>Perhatian!</strong> Anda belum lulus quiz. Nilai minimal kelulusan adalah 70.
                            </div>
                            @endif

                            <div class="d-flex gap-2">
                                <a href="{{ route('student.course-learn', session('quiz_result.course_id', 1)) }}" class="btn btn-outline-secondary">
                                    Kembali ke Kursus
                                </a>
                                @if(session('quiz_result.lulus'))
                                <form action="{{ route('student.certificate.store', [session('quiz_result.course_id', 1), session('quiz_result.quiz_id', 0)]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-certificate me-2"></i> Cetak Sertifikat
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection