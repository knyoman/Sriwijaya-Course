@extends('layouts.app')
@section('title', 'Materi Kursus - Pengajar')
@section('content')
<div class="d-flex">
    @include('components.sidebar-teacher')
    <main style="margin-left: 250px; padding-top: 70px;" class="flex-fill p-4">
        <!-- Header -->
        <div class="mb-4">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('teacher.courses') }}" class="text-decoration-none text-muted me-2">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <h5 class="mb-1">Materi Kursus - {{ $course->nama }}</h5>
                    <p class="text-muted small mb-0">Kelola materi pembelajaran untuk kursus ini</p>
                </div>
            </div>
        </div>

        <!-- Add Material Button -->
        <div class="mb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMateri">
                <i class="fa-solid fa-plus me-2"></i>Tambah Materi
            </button>
            <a href="{{ route('teacher.course.submissions', $course->id) }}" class="btn btn-secondary ms-2">
                <i class="fa-solid fa-inbox me-2"></i>Lihat Submissions
            </a>
        </div>

        <!-- Materials List -->
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Materi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($course->materi as $index => $mat)
                        <tr>
                            <td class="fw-bold" style="width: 60px;">{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-bold">
                                    {{ $mat->judul_materi }}
                                </div>
                                <small class="text-muted">{{ Str::limit($mat->deskripsi, 60) ?? 'Tidak ada deskripsi' }}</small>
                            </td>
                            <td style="width: 250px;">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetailMateri{{ $mat->id }}" title="Lihat Detail Materi">
                                        <i class="fa-solid fa-eye me-1"></i>Detail
                                    </button>
                                    <form action="{{ route('materi.destroy', $mat->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Materi" onclick="return confirm('Yakin hapus materi ini?')">
                                            <i class="fa-solid fa-trash-can me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                <i class="fa-solid fa-inbox me-2"></i>Belum ada materi. <a href="#" onclick="document.querySelector('[data-bs-target=\'#modalTambahMateri\']').click()">Tambah materi</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quiz Section -->
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Quiz Kursus</h5>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahQuiz">
                    <i class="fa-solid fa-plus me-2"></i>Tambah Quiz
                </button>
            </div>

            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Quiz</th>
                                <th>Jumlah Soal</th>
                                <th>Durasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($course->quiz as $index => $q)
                            <tr>
                                <td class="fw-bold">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold">{{ $q->nama_quiz }}</div>
                                </td>
                                <td>{{ $q->jumlah_soal }} soal</td>
                                <td>{{ $q->durasi_menit }} menit</td>
                                <td style="width: 200px;">
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditSoalQuiz{{ $q->id }}" title="Edit Quiz">
                                            <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                                        </button>
                                        <a href="{{ route('soal-quiz.edit', $q->id) }}" class="btn btn-sm btn-info" title="Edit Soal">
                                            <i class="fa-solid fa-question me-1"></i>Soal
                                        </a>
                                        <form action="{{ route('quiz.destroy', $q->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus Quiz" onclick="return confirm('Yakin hapus quiz ini?')">
                                                <i class="fa-solid fa-trash-can me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fa-solid fa-inbox me-2"></i>Belum ada quiz
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Forum Diskusi Section -->
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Forum Diskusi</h5>
                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahDiskusi">
                    <i class="fa-solid fa-plus me-2"></i>Buat Diskusi
                </button>
            </div>

            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Topik Diskusi</th>
                                <th>Pembuat</th>
                                <th>Balasan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($course->diskusi as $disk)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $disk->judul }}</div>
                                    <small class="text-muted">{{ Str::limit($disk->konten, 60) }}</small>
                                </td>
                                <td>
                                    <small>{{ $disk->pembuat->nama }}</small><br>
                                    <small class="text-muted">{{ $disk->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $disk->jumlah_balasan }}</span>
                                </td>
                                <td style="width: 150px;">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('teacher.courses.diskusi.show', [$course->id, $disk->id]) }}" class="btn btn-sm btn-primary" title="Lihat Diskusi">
                                            <i class="fa-solid fa-eye me-1"></i>Lihat
                                        </a>
                                        @if(auth()->id() === $disk->pembuat_id)
                                        <form action="{{ route('teacher.courses.diskusi.destroy', [$course->id, $disk->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus diskusi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fa-solid fa-inbox me-2"></i>Belum ada diskusi. Mulai diskusi pertama!
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Modal Tambah Diskusi -->
<div class="modal fade" id="modalTambahDiskusi" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Topik Diskusi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('teacher.courses.diskusi.store', $course->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul_disk" class="form-label">Judul Diskusi</label>
                        <input type="text" class="form-control" id="judul_disk" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="konten_disk" class="form-label">Pertanyaan/Topik</label>
                        <textarea class="form-control" id="konten_disk" name="konten" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Diskusi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Materi (Loop untuk setiap materi) -->
@foreach($course->materi as $mat)
<div class="modal fade" id="modalDetailMateri{{ $mat->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom">
                <div>
                    <h5 class="modal-title mb-1">{{ $mat->judul_materi }}</h5>
                    <small class="text-muted">Urutan Materi #{{ $mat->urutan }}</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Tipe Konten -->
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fa-solid fa-tag text-primary"></i>
                        <label class="form-label fw-bold mb-0">Tipe Konten</label>
                    </div>
                    <p class="ms-4">
                        @if($mat->tipe_konten === 'video')
                        <span class="badge bg-danger"><i class="fa-solid fa-video me-1"></i>Video</span>
                        @else
                        <span class="badge bg-warning text-dark"><i class="fa-solid fa-file me-1"></i>Dokumen</span>
                        @endif
                    </p>
                </div>

                <!-- Deskripsi -->
                @if($mat->deskripsi)
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fa-solid fa-align-left text-primary"></i>
                        <label class="form-label fw-bold mb-0">Deskripsi</label>
                    </div>
                    <div class="ms-4 p-3 bg-light rounded">
                        <p class="mb-0">{{ $mat->deskripsi }}</p>
                    </div>
                </div>
                @endif

                <!-- Info Durasi dan Urutan -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-clock text-primary"></i>
                            <label class="form-label fw-bold mb-0">Durasi</label>
                        </div>
                        <p class="ms-4 mb-0">
                            @if($mat->durasi_menit)
                            <strong>{{ $mat->durasi_menit }} menit</strong>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-list-ol text-primary"></i>
                            <label class="form-label fw-bold mb-0">Urutan</label>
                        </div>
                        <p class="ms-4 mb-0"><strong>{{ $mat->urutan }}</strong></p>
                    </div>
                </div>

                <!-- Link Konten -->
                @if($mat->url_konten)
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fa-solid fa-link text-primary"></i>
                        <label class="form-label fw-bold mb-0">Link Konten</label>
                    </div>
                    <p class="ms-4">
                        <a href="{{ $mat->url_konten }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>Buka Link
                        </a>
                    </p>
                </div>
                @endif

                <!-- Instruksi Tugas -->
                @if($mat->tugas_instruksi)
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fa-solid fa-clipboard text-primary"></i>
                        <label class="form-label fw-bold mb-0">Instruksi Tugas</label>
                    </div>
                    <div class="ms-4 p-3 bg-light rounded">
                        <p class="mb-0">{{ $mat->tugas_instruksi }}</p>
                    </div>
                </div>
                @endif

                <!-- Soal/Petunjuk Tugas -->
                @if($mat->tugas_soal)
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fa-solid fa-lightbulb text-primary"></i>
                        <label class="form-label fw-bold mb-0">Soal/Petunjuk</label>
                    </div>
                    <div class="ms-4 p-3 bg-light rounded">
                        <p class="mb-0">{{ $mat->tugas_soal }}</p>
                    </div>
                </div>
                @endif

                <!-- Tanggal Dibuat -->
                <div class="pt-3 border-top">
                    <small class="text-muted">
                        <i class="fa-solid fa-calendar-days me-1"></i>
                        Dibuat pada: <strong>{{ $mat->created_at->format('d/m/Y H:i') }}</strong>
                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditMateri{{ $mat->id }}" data-bs-dismiss="modal">
                    <i class="fa-solid fa-pen-to-square me-1"></i>Edit Materi
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Materi -->
<div class="modal fade" id="modalEditMateri{{ $mat->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Materi - {{ $mat->judul_materi }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('materi.update', $mat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Materi</label>
                        <input type="text" class="form-control" name="judul_materi" value="{{ $mat->judul_materi }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3">{{ $mat->deskripsi }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Urutan Materi</label>
                            <input type="number" class="form-control" name="urutan" value="{{ $mat->urutan }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe Konten</label>
                            <select class="form-select" name="tipe_konten" required>
                                <option value="video" {{ $mat->tipe_konten === 'video' ? 'selected' : '' }}>Video</option>
                                <option value="dokumen" {{ $mat->tipe_konten === 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL Konten (opsional)</label>
                        <input type="url" class="form-control" name="url_konten" value="{{ $mat->url_konten }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Durasi (menit, opsional)</label>
                        <input type="number" class="form-control" name="durasi_menit" value="{{ $mat->durasi_menit }}">
                    </div>
                    <hr>
                    <h6 class="fw-bold">Tugas / Praktik (opsional)</h6>
                    {{-- Tugas aktifkan checkbox removed per request --}}
                    <div class="mb-3">
                        <label class="form-label">Instruksi Tugas</label>
                        <textarea class="form-control" name="tugas_instruksi" rows="3" placeholder="Tulis instruksi tugas yang harus dikerjakan oleh pelajar">{{ $mat->tugas_instruksi }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Soal / Petunjuk</label>
                        <textarea class="form-control" name="tugas_soal" rows="3" placeholder="Contoh: Buat sebuah website sederhana menggunakan HTML/CSS...">{{ $mat->tugas_soal }}</textarea>
                    </div>
                    {{-- Batas Waktu removed --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Tambah Materi -->
<div class="modal fade" id="modalTambahMateri" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Materi Kursus {{ $course->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('materi.store', $course->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Materi</label>
                        <input type="text" class="form-control" name="judul_materi" placeholder="Masukkan judul materi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3" placeholder="Jelaskan materi ini..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Urutan Materi</label>
                            <input type="number" class="form-control" name="urutan" placeholder="1" value="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe Konten</label>
                            <select class="form-select" name="tipe_konten" required>
                                <option value="">-- Pilih Tipe --</option>
                                <option value="video">Video</option>
                                <option value="dokumen">Dokumen</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL Konten (opsional)</label>
                        <input type="url" class="form-control" name="url_konten" placeholder="https://youtu.be/...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Durasi (menit, opsional)</label>
                        <input type="number" class="form-control" name="durasi_menit" placeholder="30">
                    </div>
                    <hr>
                    <h6 class="fw-bold">Tugas / Praktik (opsional)</h6>
                    {{-- Tugas aktifkan checkbox removed per request --}}
                    <div class="mb-3">
                        <label class="form-label">Instruksi Tugas</label>
                        <textarea class="form-control" name="tugas_instruksi" rows="3" placeholder="Tulis instruksi tugas yang harus dikerjakan oleh pelajar"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Soal / Petunjuk</label>
                        <textarea class="form-control" name="tugas_soal" rows="3" placeholder="Contoh: Buat sebuah website sederhana menggunakan HTML/CSS..."></textarea>
                    </div>
                    {{-- Batas Waktu removed --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Materi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Quiz (Loop untuk setiap quiz) -->
@foreach($course->quiz as $q)
<div class="modal fade" id="modalEditSoalQuiz{{ $q->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Quiz - {{ $q->nama_quiz }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('quiz.update', $q->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Quiz</label>
                        <input type="text" class="form-control" name="nama_quiz" value="{{ $q->nama_quiz }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="2">{{ $q->deskripsi }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Jumlah Soal</label>
                            <input type="number" class="form-control" name="jumlah_soal" value="{{ $q->jumlah_soal }}" min="1" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Durasi (menit)</label>
                            <input type="number" class="form-control" name="durasi_menit" value="{{ $q->durasi_menit }}" min="1" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Urutan</label>
                            <input type="number" class="form-control" name="urutan" value="{{ $q->urutan }}" required>
                        </div>
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
@endforeach

<!-- Modal Tambah Quiz -->
<div class="modal fade" id="modalTambahQuiz" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Quiz Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('quiz.store', $course->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Quiz</label>
                        <input type="text" class="form-control" name="nama_quiz" placeholder="Contoh: Quiz 1 - Pemahaman Dasar" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Quiz</label>
                        <textarea class="form-control" name="deskripsi" rows="2" placeholder="Jelaskan tujuan quiz ini..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Jumlah Soal</label>
                            <input type="number" class="form-control" name="jumlah_soal" placeholder="10" min="1" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Durasi (menit)</label>
                            <input type="number" class="form-control" name="durasi_menit" placeholder="15" min="1" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Urutan</label>
                            <input type="number" class="form-control" name="urutan" placeholder="1" value="1" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Quiz</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Soal Quiz -->
<div class="modal fade" id="modalEditSoalQuiz" tabindex="-1" size="lg">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Soal Quiz: Pemahaman Dasar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahSoal">
                        <i class="fa-solid fa-plus me-1"></i>Tambah Soal
                    </button>
                </div>

                <!-- Soal 1 -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Soal 1</h6>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditSoalIndividual" title="Edit Soal 1">
                                    <i class="fa-solid fa-pen-to-square"></i>Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusSoal" title="Hapus Soal 1">
                                    <i class="fa-solid fa-trash-can"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="fw-bold mb-2">Apa yang dimaksud dengan konsep dasar?</p>
                        <div class="ms-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal1">
                                <label class="form-check-label">A. Penjelasan fundamental tentang suatu topik</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal1" checked>
                                <label class="form-check-label"><strong>B. Awal mula pelajaran</strong> (Jawaban Benar)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal1">
                                <label class="form-check-label">C. Sesuatu yang mudah dipahami</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal1">
                                <label class="form-check-label">D. Teori yang kompleks</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Soal 2 -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Soal 2</h6>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditSoalIndividual" title="Edit Soal 2">
                                    <i class="fa-solid fa-pen-to-square"></i>Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusSoal" title="Hapus Soal 2">
                                    <i class="fa-solid fa-trash-can"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="fw-bold mb-2">Manakah yang termasuk langkah pertama?</p>
                        <div class="ms-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal2">
                                <label class="form-check-label">A. Implementasi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal2" checked>
                                <label class="form-check-label"><strong>B. Perencanaan</strong> (Jawaban Benar)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal2">
                                <label class="form-check-label">C. Evaluasi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal2">
                                <label class="form-check-label">D. Pelaporan</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Soal 3 -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Soal 3</h6>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditSoalIndividual" title="Edit Soal 3">
                                    <i class="fa-solid fa-pen-to-square"></i>Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusSoal" title="Hapus Soal 3">
                                    <i class="fa-solid fa-trash-can"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="fw-bold mb-2">Apa keuntungan utama dari metode ini?</p>
                        <div class="ms-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal3">
                                <label class="form-check-label">A. Lebih murah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal3" checked>
                                <label class="form-check-label"><strong>B. Efisiensi waktu</strong> (Jawaban Benar)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal3">
                                <label class="form-check-label">C. Lebih rumit</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soal3">
                                <label class="form-check-label">D. Tidak ada keuntungan</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Soal -->
<div class="modal fade" id="modalTambahSoal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Soal Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Soal</label>
                        <textarea class="form-control" rows="3" placeholder="Masukkan pertanyaan soal..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilihan Jawaban</label>
                        <div class="mb-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">A</span>
                                <input type="text" class="form-control" placeholder="Jawaban A" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">B</span>
                                <input type="text" class="form-control" placeholder="Jawaban B" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">C</span>
                                <input type="text" class="form-control" placeholder="Jawaban C" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">D</span>
                                <input type="text" class="form-control" placeholder="Jawaban D" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jawaban Benar</label>
                        <select class="form-select" required>
                            <option>-- Pilih Jawaban Benar --</option>
                            <option value="A">A</option>
                            <option value="B" selected>B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Soal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Soal Individual -->
<div class="modal fade" id="modalEditSoalIndividual" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Soal</label>
                        <textarea class="form-control" rows="3" placeholder="Masukkan pertanyaan soal..." required>Apa yang dimaksud dengan konsep dasar?</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilihan Jawaban</label>
                        <div class="mb-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">A</span>
                                <input type="text" class="form-control" placeholder="Jawaban A" value="Penjelasan fundamental tentang suatu topik" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">B</span>
                                <input type="text" class="form-control" placeholder="Jawaban B" value="Awal mula pelajaran" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">C</span>
                                <input type="text" class="form-control" placeholder="Jawaban C" value="Sesuatu yang mudah dipahami" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">D</span>
                                <input type="text" class="form-control" placeholder="Jawaban D" value="Teori yang kompleks" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jawaban Benar</label>
                        <select class="form-select" required>
                            <option value="A">A</option>
                            <option value="B" selected>B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
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

<!-- Modal Hapus Soal -->
<div class="modal fade" id="modalHapusSoal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Soal?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger"><i class="fa-solid fa-exclamation-triangle me-2"></i>Apakah Anda yakin ingin menghapus soal ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus Soal</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Script untuk tab functionality sudah built-in dengan Bootstrap
</script>

<!-- Modal Edit Video -->
<div class="modal fade" id="modalEditVideo" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Video Pembelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Link Video YouTube</label>
                        <input type="url" class="form-control" placeholder="https://youtu.be/..." value="https://youtu.be/example" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Video</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Video -->
<div class="modal fade" id="modalHapusVideo" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Video?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger"><i class="fa-solid fa-exclamation-triangle me-2"></i>Apakah Anda yakin ingin menghapus video ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus Video</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Deskripsi -->
<div class="modal fade" id="modalEditDeskripsi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Deskripsi Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Singkat</label>
                        <textarea class="form-control" rows="4" placeholder="Jelaskan materi ini..." required>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Materi ini membahas tentang...</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Deskripsi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Deskripsi -->
<div class="modal fade" id="modalHapusDeskripsi" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Deskripsi?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger"><i class="fa-solid fa-exclamation-triangle me-2"></i>Apakah Anda yakin ingin menghapus deskripsi ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus Deskripsi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Forum -->
<div class="modal fade" id="modalHapusForum" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Forum?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger"><i class="fa-solid fa-exclamation-triangle me-2"></i>Apakah Anda yakin ingin menghapus forum diskusi ini? Semua diskusi akan dihapus. Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus Forum</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pertanyaan Forum -->
<div class="modal fade" id="modalDetailPertanyaan" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pertanyaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Pertanyaan -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Pertanyaan 1: Bagaimana cara...?</h6>
                    <div class="alert alert-light border">
                        <small class="text-muted">Oleh: <strong>Pelajar Satu</strong> - 2 Agustus 2024 pukul 14:30</small>
                        <p class="mt-2 mb-0">Bagaimana cara menerapkan konsep ini dalam praktik sehari-hari? Apakah ada contoh konkret yang bisa dijelaskan lebih detail?</p>
                    </div>
                </div>

                <!-- Komentar -->
                <div class="mb-3">
                    <h6 class="fw-bold mb-3">Komentar (2)</h6>

                    <!-- Komentar 1 -->
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <strong>Pengajar</strong>
                                <small class="text-muted">3 Agustus 2024 pukul 09:15</small>
                            </div>
                            <p class="mb-0">Terima kasih atas pertanyaan yang bagus! Berikut adalah contoh praktisnya: pertama-tama Anda perlu memahami fondasi teorinya, kemudian aplikasikan dalam skenario nyata.</p>
                        </div>
                    </div>

                    <!-- Komentar 2 -->
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <strong>Pelajar Dua</strong>
                                <small class="text-muted">3 Agustus 2024 pukul 10:45</small>
                            </div>
                            <p class="mb-0">Penjelasan yang sangat membantu! Sekarang saya lebih memahami konsepnya. Terima kasih atas jawaban detailnya.</p>
                        </div>
                    </div>
                </div>

                <!-- Form Tambah Komentar -->
                <div class="mb-3">
                    <hr>
                    <label class="form-label fw-bold">Tambah Komentar</label>
                    <textarea class="form-control" rows="2" placeholder="Tulis komentar Anda..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Kirim Komentar</button>
            </div>
        </div>
    </div>
</div>
@endsection