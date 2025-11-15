@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2>{{ $quiz->nama_quiz }}</h2>
                    <p class="text-muted">{{ $quiz->deskripsi }}</p>
                </div>
                <a href="{{ route('teacher.course-materials', $course->id) }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h6>Terjadi kesalahan:</h6>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="daftar-tab" data-bs-toggle="tab" data-bs-target="#daftar" type="button" role="tab" aria-controls="daftar" aria-selected="true">
                        <i class="bi bi-list-check"></i> Daftar Soal ({{ $quiz->soal->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tambah-tab" data-bs-toggle="tab" data-bs-target="#tambah" type="button" role="tab" aria-controls="tambah" aria-selected="false">
                        <i class="bi bi-plus-circle"></i> Tambah Soal
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Daftar Soal Tab -->
                <div class="tab-pane fade show active" id="daftar" role="tabpanel" aria-labelledby="daftar-tab">
                    @forelse($quiz->soal as $soal)
                    <div class="card mb-3">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">Soal {{ $soal->urutan }}</h6>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSoalModal{{ $soal->id }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                <form action="{{ route('soal-quiz.destroy', $soal->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus soal ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">{{ $soal->pertanyaan }}</h6>
                            <div class="ps-3">
                                <p class="mb-1"><strong>A.</strong> {{ $soal->pilihan_a }}</p>
                                <p class="mb-1"><strong>B.</strong> {{ $soal->pilihan_b }}</p>
                                <p class="mb-1"><strong>C.</strong> {{ $soal->pilihan_c }}</p>
                                <p class="mb-1"><strong>D.</strong> {{ $soal->pilihan_d }}</p>
                            </div>
                            <hr>
                            <p class="mb-0"><strong>Jawaban Benar:</strong> <span class="badge bg-success">{{ $soal->jawaban_benar }}</span></p>
                        </div>
                    </div>

                    <!-- Edit Modal untuk setiap soal -->
                    <div class="modal fade" id="editSoalModal{{ $soal->id }}" tabindex="-1" aria-labelledby="editSoalModalLabel{{ $soal->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSoalModalLabel{{ $soal->id }}">Edit Soal {{ $soal->urutan }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('soal-quiz.update', $soal->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="pertanyaan{{ $soal->id }}" class="form-label">Pertanyaan</label>
                                            <textarea class="form-control @error('pertanyaan') is-invalid @enderror" id="pertanyaan{{ $soal->id }}" name="pertanyaan" rows="3" required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                                            @error('pertanyaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pilihan_a{{ $soal->id }}" class="form-label">Pilihan A</label>
                                            <input type="text" class="form-control @error('pilihan_a') is-invalid @enderror" id="pilihan_a{{ $soal->id }}" name="pilihan_a" value="{{ old('pilihan_a', $soal->pilihan_a) }}" required>
                                            @error('pilihan_a')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pilihan_b{{ $soal->id }}" class="form-label">Pilihan B</label>
                                            <input type="text" class="form-control @error('pilihan_b') is-invalid @enderror" id="pilihan_b{{ $soal->id }}" name="pilihan_b" value="{{ old('pilihan_b', $soal->pilihan_b) }}" required>
                                            @error('pilihan_b')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pilihan_c{{ $soal->id }}" class="form-label">Pilihan C</label>
                                            <input type="text" class="form-control @error('pilihan_c') is-invalid @enderror" id="pilihan_c{{ $soal->id }}" name="pilihan_c" value="{{ old('pilihan_c', $soal->pilihan_c) }}" required>
                                            @error('pilihan_c')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pilihan_d{{ $soal->id }}" class="form-label">Pilihan D</label>
                                            <input type="text" class="form-control @error('pilihan_d') is-invalid @enderror" id="pilihan_d{{ $soal->id }}" name="pilihan_d" value="{{ old('pilihan_d', $soal->pilihan_d) }}" required>
                                            @error('pilihan_d')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="jawaban_benar{{ $soal->id }}" class="form-label">Jawaban Benar</label>
                                            <select class="form-select @error('jawaban_benar') is-invalid @enderror" id="jawaban_benar{{ $soal->id }}" name="jawaban_benar" required>
                                                <option value="">-- Pilih Jawaban Benar --</option>
                                                <option value="A" {{ old('jawaban_benar', $soal->jawaban_benar) == 'A' ? 'selected' : '' }}>A</option>
                                                <option value="B" {{ old('jawaban_benar', $soal->jawaban_benar) == 'B' ? 'selected' : '' }}>B</option>
                                                <option value="C" {{ old('jawaban_benar', $soal->jawaban_benar) == 'C' ? 'selected' : '' }}>C</option>
                                                <option value="D" {{ old('jawaban_benar', $soal->jawaban_benar) == 'D' ? 'selected' : '' }}>D</option>
                                            </select>
                                            @error('jawaban_benar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="urutan{{ $soal->id }}" class="form-label">Urutan</label>
                                            <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan{{ $soal->id }}" name="urutan" value="{{ old('urutan', $soal->urutan) }}" min="1" required>
                                            @error('urutan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info" role="alert">
                        <i class="bi bi-info-circle"></i> Belum ada soal. Silakan tambahkan soal baru.
                    </div>
                    @endforelse
                </div>

                <!-- Tambah Soal Tab -->
                <div class="tab-pane fade" id="tambah" role="tabpanel" aria-labelledby="tambah-tab">
                    <form action="{{ route('soal-quiz.store', ['courseId' => $course->id, 'quizId' => $quiz->id]) }}" method="POST">
                        @csrf

                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="pertanyaan_baru" class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('pertanyaan') is-invalid @enderror" id="pertanyaan_baru" name="pertanyaan" rows="3" placeholder="Masukkan pertanyaan soal" required>{{ old('pertanyaan') }}</textarea>
                                    @error('pertanyaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="pilihan_a_baru" class="form-label">Pilihan A <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('pilihan_a') is-invalid @enderror" id="pilihan_a_baru" name="pilihan_a" placeholder="Masukkan pilihan A" required value="{{ old('pilihan_a') }}">
                                        @error('pilihan_a')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pilihan_b_baru" class="form-label">Pilihan B <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('pilihan_b') is-invalid @enderror" id="pilihan_b_baru" name="pilihan_b" placeholder="Masukkan pilihan B" required value="{{ old('pilihan_b') }}">
                                        @error('pilihan_b')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="pilihan_c_baru" class="form-label">Pilihan C <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('pilihan_c') is-invalid @enderror" id="pilihan_c_baru" name="pilihan_c" placeholder="Masukkan pilihan C" required value="{{ old('pilihan_c') }}">
                                        @error('pilihan_c')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pilihan_d_baru" class="form-label">Pilihan D <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('pilihan_d') is-invalid @enderror" id="pilihan_d_baru" name="pilihan_d" placeholder="Masukkan pilihan D" required value="{{ old('pilihan_d') }}">
                                        @error('pilihan_d')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="jawaban_benar_baru" class="form-label">Jawaban Benar <span class="text-danger">*</span></label>
                                        <select class="form-select @error('jawaban_benar') is-invalid @enderror" id="jawaban_benar_baru" name="jawaban_benar" required>
                                            <option value="">-- Pilih Jawaban Benar --</option>
                                            <option value="A" {{ old('jawaban_benar') == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" {{ old('jawaban_benar') == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="C" {{ old('jawaban_benar') == 'C' ? 'selected' : '' }}>C</option>
                                            <option value="D" {{ old('jawaban_benar') == 'D' ? 'selected' : '' }}>D</option>
                                        </select>
                                        @error('jawaban_benar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="urutan_baru" class="form-label">Urutan <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan_baru" name="urutan" placeholder="1" min="1" required value="{{ old('urutan', $quiz->soal->count() + 1) }}">
                                        @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Simpan Soal
                                </button>
                                <a href="{{ route('teacher.course-materials', $course->id) }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x"></i> Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection