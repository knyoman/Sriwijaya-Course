@extends('layouts.app')

@section('title', 'Quiz - ' . $quiz->nama_quiz)

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem; padding-top: 70px;">
        <div class="container-fluid">
            <a href="{{ route('student.course-learn', $course->id) }}" class="btn btn-outline-secondary btn-sm mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="fw-bold mb-0">{{ $quiz->nama_quiz }}</h5>
                            @if($quiz->deskripsi)
                            <small class="text-white-50">{{ $quiz->deskripsi }}</small>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info mb-4">
                                <i class="fa-solid fa-circle-info me-2"></i>
                                <strong>Informasi Quiz:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Jumlah Soal yang Ditampilkan: {{ isset($soalRandom) ? $soalRandom->count() : $quiz->soal->count() }}</li>
                                    <li>Total Soal Tersedia: {{ $quiz->soal->count() }}</li>
                                    <li>Waktu: {{ $quiz->durasi_menit }} menit</li>
                                    <li>Nilai Kelulusan: 70</li>
                                </ul>
                            </div>

                            @if(isset($soalRandom) && $soalRandom->count() > 0)
                            <form id="quizForm" action="{{ route('student.quiz.submit', [$course->id, $quiz->id]) }}" method="POST">
                                @csrf

                                @forelse($soalRandom as $index => $soal)
                                <!-- Question -->
                                <div class="mb-4 p-3 bg-light rounded">
                                    <h6 class="fw-bold mb-3">
                                        <span class="badge bg-primary me-2">{{ $index + 1 }}</span>
                                        {{ $soal->pertanyaan }}
                                    </h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="jawaban[{{ $soal->id }}]" id="soal{{ $soal->id }}_a" value="a" required>
                                        <label class="form-check-label" for="soal{{ $soal->id }}_a">
                                            {{ $soal->pilihan_a }}
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="jawaban[{{ $soal->id }}]" id="soal{{ $soal->id }}_b" value="b" required>
                                        <label class="form-check-label" for="soal{{ $soal->id }}_b">
                                            {{ $soal->pilihan_b }}
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="jawaban[{{ $soal->id }}]" id="soal{{ $soal->id }}_c" value="c" required>
                                        <label class="form-check-label" for="soal{{ $soal->id }}_c">
                                            {{ $soal->pilihan_c }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jawaban[{{ $soal->id }}]" id="soal{{ $soal->id }}_d" value="d" required>
                                        <label class="form-check-label" for="soal{{ $soal->id }}_d">
                                            {{ $soal->pilihan_d }}
                                        </label>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-warning">
                                    <i class="fa-solid fa-exclamation-triangle me-2"></i>
                                    Soal quiz belum tersedia. Hubungi instruktur Anda.
                                </div>
                                @endforelse

                                <div class="d-flex gap-2 mt-4">
                                    <a href="{{ route('student.course-learn', $course->id) }}" class="btn btn-outline-secondary">Batalkan</a>
                                    @if(isset($soalRandom) && $soalRandom->count() > 0)
                                    <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#confirmQuizModal">
                                        Selesaikan Quiz
                                    </button>
                                    @endif
                                </div>
                            </form>
                            @else
                            <div class="alert alert-warning">
                                <i class="fa-solid fa-exclamation-triangle me-2"></i>
                                Soal quiz belum tersedia. Hubungi instruktur Anda untuk menambahkan soal.
                            </div>
                            <a href="{{ route('student.course-learn', $course->id) }}" class="btn btn-outline-secondary">Kembali</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Confirm Quiz Modal -->
<div class="modal fade" id="confirmQuizModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Selesaikan Quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menyelesaikan quiz? Anda tidak dapat mengubah jawaban setelah submit.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" form="quizForm" class="btn btn-primary">Ya, Selesaikan</button>
            </div>
        </div>
    </div>
</div>
@endsection