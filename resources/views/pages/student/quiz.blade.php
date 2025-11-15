@extends('layouts.app')

@section('title', 'Quiz - Kursus Sriwijaya')

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
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="fw-bold mb-0">Quiz: Web Development Basics</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info mb-4">
                                <i class="fa-solid fa-circle-info me-2"></i>
                                <strong>Informasi Quiz:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Jumlah Soal: 10</li>
                                    <li>Waktu: 30 menit</li>
                                    <li>Nilai Kelulusan: 70</li>
                                </ul>
                            </div>

                            <form id="quizForm">
                                <!-- Question 1 -->
                                <div class="mb-4 p-3 bg-light rounded">
                                    <h6 class="fw-bold mb-3">
                                        <span class="badge bg-primary me-2">1</span>
                                        Apa singkatan dari HTML?
                                    </h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="question1" id="q1a" value="a">
                                        <label class="form-check-label" for="q1a">
                                            HyperText Markup Language
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="question1" id="q1b" value="b">
                                        <label class="form-check-label" for="q1b">
                                            High Tech Markup Language
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="question1" id="q1c" value="c">
                                        <label class="form-check-label" for="q1c">
                                            Home Tool Markup Language
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question1" id="q1d" value="d">
                                        <label class="form-check-label" for="q1d">
                                            Hyperlinks and Text Markup Language
                                        </label>
                                    </div>
                                </div>

                                <!-- Question 2 -->
                                <div class="mb-4 p-3 bg-light rounded">
                                    <h6 class="fw-bold mb-3">
                                        <span class="badge bg-primary me-2">2</span>
                                        Tag HTML mana yang digunakan untuk membuat paragraph?
                                    </h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="question2" id="q2a" value="a">
                                        <label class="form-check-label" for="q2a">
                                            &lt;p&gt;
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="question2" id="q2b" value="b">
                                        <label class="form-check-label" for="q2b">
                                            &lt;paragraph&gt;
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="question2" id="q2c" value="c">
                                        <label class="form-check-label" for="q2c">
                                            &lt;para&gt;
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question2" id="q2d" value="d">
                                        <label class="form-check-label" for="q2d">
                                            &lt;pg&gt;
                                        </label>
                                    </div>
                                </div>

                                <!-- Question 3 -->
                                <div class="mb-4 p-3 bg-light rounded">
                                    <h6 class="fw-bold mb-3">
                                        <span class="badge bg-primary me-2">3</span>
                                        Apa fungsi CSS?
                                    </h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="question3" id="q3a" value="a">
                                        <label class="form-check-label" for="q3a">
                                            Untuk membuat struktur halaman
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="question3" id="q3b" value="b">
                                        <label class="form-check-label" for="q3b">
                                            Untuk styling dan tampilan halaman
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="question3" id="q3c" value="c">
                                        <label class="form-check-label" for="q3c">
                                            Untuk membuat database
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question3" id="q3d" value="d">
                                        <label class="form-check-label" for="q3d">
                                            Untuk membuat server
                                        </label>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 mt-4">
                                    <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Batalkan</button>
                                    <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#confirmQuizModal">
                                        Selesaikan Quiz
                                    </button>
                                </div>
                            </form>
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
                <a href="{{ route('student.quiz-result') }}" class="btn btn-primary">Ya, Selesaikan</a>
            </div>
        </div>
    </div>
</div>
@endsection