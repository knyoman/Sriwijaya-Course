@extends('layouts.app')
@section('title', 'Materi Kursus - ' . $course->nama)
@section('content')
<div class="container-fluid p-4">
    <style>
        /* Modal and table tweaks to make modals more compact and readable */
        .modal .modal-dialog.modal-lg {
            max-width: 880px;
        }

        .modal .modal-title {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .modal-body p.text-muted {
            margin-bottom: 0.75rem;
        }

        .modal-body dl dt {
            font-weight: 700;
        }

        .modal-body dl dd {
            margin-left: 0;
            margin-bottom: .75rem;
        }

        .table.table-sm td,
        .table.table-sm th {
            padding: .5rem .6rem;
        }

        .btn-sm {
            padding: .32rem .5rem;
        }

        @media (max-width: 768px) {
            .modal .modal-dialog.modal-lg {
                max-width: 95%;
            }
        }

        /* Ensure modal body scrolls on long content */
        .modal-body {
            max-height: 65vh;
            overflow: auto;
            white-space: pre-wrap;
        }

        /* Tighten modal spacing */
        .modal-header {
            padding: .8rem 1rem;
        }

        .modal-footer {
            padding: .6rem 1rem;
        }

        .modal .modal-title {
            font-size: 1.15rem;
        }
    </style>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4>{{ $course->nama }}</h4>
            <small class="text-muted">Kelola materi pembelajaran untuk kursus ini</small>
        </div>
        <a href="{{ route('teacher.courses') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    <!-- Tombol Tambah Materi -->
    <div class="mb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMateriModal">
            <i class="bi bi-plus-circle"></i> Tambah Materi
        </button>
    </div>

    <!-- Tabel Materi -->
    <div class="card shadow-sm">
        <div class="card-body">
            @if($materiList->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-sm align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Materi</th>
                            <th>Deskripsi</th>
                            <th>Tipe Konten</th>
                            <th>Durasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materiList as $index => $materi)
                        <tr>
                            <td style="width:60px">{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $materi->judul_materi }}</strong><br>
                                <small class="text-muted">{{ Str::limit($materi->deskripsi, 80) }}</small>
                            </td>
                            <td class="text-muted" style="max-width:240px">{{ Str::limit($materi->deskripsi ?? '-', 60) }}</td>
                            <td style="width:120px">
                                @if($materi->tipe_konten === 'video')
                                <span class="badge bg-danger">Video</span>
                                @elseif($materi->tipe_konten === 'dokumen')
                                <span class="badge bg-info">Dokumen</span>
                                @elseif(in_array($materi->tipe_konten, ['tugas','praktek']))
                                <span class="badge bg-warning text-dark">{{ ucfirst($materi->tipe_konten) }}</span>
                                @else
                                <span class="badge bg-secondary">{{ $materi->tipe_konten ?? 'Lainnya' }}</span>
                                @endif
                            </td>
                            <td style="width:120px">{{ $materi->durasi_menit ?? '-' }} menit</td>
                            <td style="width:180px">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewMateriModal{{ $materi->id }}" title="Detail">Detail</button>
                                <form action="{{ route('materi.delete', [$course->id, $materi->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus materi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Render modals for each materi outside the table to avoid nesting/layout issues --}}
            @foreach($materiList as $materi)
            <!-- Modal View Materi (read-only) -->
            <div class="modal fade" id="viewMateriModal{{ $materi->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $materi->judul_materi }}
                                @if(config('app.debug'))
                                <span class="badge bg-danger ms-2">MODIFIED</span>
                                @endif
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        @php
                        // prepare embed url for youtube links
                        $embedUrl = null;
                        if(!empty($materi->url_konten)) {
                        $u = $materi->url_konten;
                        if(Str::contains($u, 'youtube.com/embed/')) {
                        $embedUrl = $u;
                        } elseif(Str::contains($u, 'youtu.be')) {
                        preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $u, $m);
                        $id = $m[1] ?? null;
                        if($id) $embedUrl = 'https://www.youtube.com/embed/' . $id;
                        } elseif(Str::contains($u, 'watch')) {
                        parse_str(parse_url($u, PHP_URL_QUERY) ?: '', $query);
                        $id = $query['v'] ?? null;
                        if($id) $embedUrl = 'https://www.youtube.com/embed/' . $id;
                        }
                        }
                        @endphp
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <p class="mb-2"><strong>Deskripsi</strong></p>
                                    <p class="text-muted">{{ $materi->deskripsi ?? '-' }}</p>

                                    <div class="mt-3">
                                        <p class="mb-1"><strong>Link Konten</strong></p>
                                        @if($embedUrl)
                                        <div class="ratio ratio-16x9 mb-2">
                                            <iframe src="{{ $embedUrl }}" allowfullscreen></iframe>
                                        </div>
                                        <a href="{{ $materi->url_konten }}" target="_blank" class="d-block small">Buka di tab baru</a>
                                        @elseif($materi->url_konten)
                                        <a href="{{ $materi->url_konten }}" target="_blank" class="btn btn-sm btn-primary">Buka Link</a>
                                        @else
                                        <div class="text-muted">-</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <dl class="row">
                                        <dt class="col-6">Tipe Konten</dt>
                                        <dd class="col-6">@if($materi->tipe_konten==='video')<span class="badge bg-danger">Video</span>@elseif($materi->tipe_konten==='dokumen')<span class="badge bg-info">Dokumen</span>@elseif(in_array($materi->tipe_konten,['tugas','praktek']))<span class="badge bg-warning text-dark">{{ ucfirst($materi->tipe_konten) }}</span>@else <span class="badge bg-secondary">{{ $materi->tipe_konten ?? 'Lainnya' }}</span> @endif</dd>

                                        <dt class="col-6">Pembuat</dt>
                                        <dd class="col-6">{{ $course->pengajar->name ?? 'Pengajar' }}</dd>

                                        <dt class="col-6">Durasi</dt>
                                        <dd class="col-6">{{ $materi->durasi_menit ?? '-' }} menit</dd>

                                        <dt class="col-6">Urutan</dt>
                                        <dd class="col-6">{{ $materi->urutan ?? '-' }}</dd>

                                        <dt class="col-6">Dibuat pada</dt>
                                        <dd class="col-6">{{ $materi->created_at->format('d/m/Y H:i') }}</dd>
                                    </dl>
                                    @if(in_array($materi->tipe_konten, ['tugas','praktek']))
                                    <a href="{{ route('teacher.course.submissions', $course->id) . '?materi_id=' . $materi->id }}" class="btn btn-sm btn-outline-primary">Lihat Submissions</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editMateriModal{{ $materi->id }}" data-bs-dismiss="modal">Edit</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Materi -->
            <div class="modal fade" id="editMateriModal{{ $materi->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Materi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('materi.update', [$course->id, $materi->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Judul Materi</label>
                                    <input type="text" class="form-control" name="judul_materi" value="{{ $materi->judul_materi }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" rows="3">{{ $materi->deskripsi }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tipe Konten</label>
                                        <select class="form-control" name="tipe_konten" required>
                                            <option value="video" {{ $materi->tipe_konten === 'video' ? 'selected' : '' }}>Video</option>
                                            <option value="dokumen" {{ $materi->tipe_konten === 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                                            <option value="tugas" {{ $materi->tipe_konten === 'tugas' ? 'selected' : '' }}>Tugas</option>
                                            <option value="praktek" {{ $materi->tipe_konten === 'praktek' ? 'selected' : '' }}>Praktek</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Durasi (menit)</label>
                                        <input type="number" class="form-control" name="durasi_menit" value="{{ $materi->durasi_menit }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">URL Konten</label>
                                    <input type="url" class="form-control" name="url_konten" value="{{ $materi->url_konten }}" placeholder="https://example.com/video.mp4">
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
            @else
            <div class="alert alert-info">
                <p class="mb-0">Belum ada materi. Tambahkan materi baru dengan mengklik tombol di atas.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Forum Diskusi Section -->
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Forum Diskusi</h5>
            <a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="alert('Fitur forum diskusi segera hadir!')">
                <i class="bi bi-chat-dots"></i> Lihat Forum
            </a>
        </div>
    </div>

    <!-- Quiz Kursus Section -->
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Quiz Kursus</h5>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahQuizModal">
                <i class="bi bi-plus-circle"></i> Tambah Quiz
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @if($quizList->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
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
                            @foreach($quizList as $index => $quiz)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $quiz->nama_quiz }}</strong><br>
                                    <small class="text-muted">{{ Str::limit($quiz->deskripsi, 50) }}</small>
                                </td>
                                <td>{{ $quiz->soal->count() }} soal</td>
                                <td>{{ $quiz->durasi_menit }} menit</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editQuizModal{{ $quiz->id }}" title="Edit">Edit</button>
                                    <a href="{{ route('soal-quiz.edit', $quiz->id) }}" class="btn btn-sm btn-info" title="Soal">Soal</a>
                                    <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus quiz ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit Quiz -->
                            <div class="modal fade" id="editQuizModal{{ $quiz->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Quiz</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('quiz.update', $quiz->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Quiz</label>
                                                    <input type="text" class="form-control" name="nama_quiz" value="{{ $quiz->nama_quiz }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi</label>
                                                    <textarea class="form-control" name="deskripsi" rows="3">{{ $quiz->deskripsi }}</textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Jumlah Soal</label>
                                                        <input type="number" class="form-control" name="jumlah_soal" value="{{ $quiz->jumlah_soal }}" min="1" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Durasi (menit)</label>
                                                        <input type="number" class="form-control" name="durasi_menit" value="{{ $quiz->durasi_menit }}" min="1" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Urutan</label>
                                                    <input type="number" class="form-control" name="urutan" value="{{ $quiz->urutan }}" required>
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
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-info">
                    <p class="mb-0">Belum ada quiz. Tambahkan quiz baru dengan mengklik tombol di atas.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Materi -->
<div class="modal fade" id="tambahMateriModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Materi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('materi.store', $course->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul_materi" class="form-label">Judul Materi</label>
                        <input type="text" class="form-control @error('judul_materi') is-invalid @enderror" id="judul_materi" name="judul_materi" required>
                        @error('judul_materi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3"></textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tipe_konten" class="form-label">Tipe Konten</label>
                            <select class="form-control @error('tipe_konten') is-invalid @enderror" id="tipe_konten" name="tipe_konten" required>
                                <option value="">Pilih Tipe Konten</option>
                                <option value="video">Video</option>
                                <option value="dokumen">Dokumen</option>
                            </select>
                            @error('tipe_konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="durasi_menit" class="form-label">Durasi (menit)</label>
                            <input type="number" class="form-control @error('durasi_menit') is-invalid @enderror" id="durasi_menit" name="durasi_menit">
                            @error('durasi_menit')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="url_konten" class="form-label">URL Konten</label>
                        <input type="url" class="form-control @error('url_konten') is-invalid @enderror" id="url_konten" name="url_konten" placeholder="https://example.com/video.mp4">
                        @error('url_konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Materi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Quiz -->
<div class="modal fade" id="tambahQuizModal" tabindex="-1">
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
                        <label for="nama_quiz" class="form-label">Nama Quiz</label>
                        <input type="text" class="form-control @error('nama_quiz') is-invalid @enderror" id="nama_quiz" name="nama_quiz" placeholder="Contoh: Quiz 1 - Pemahaman Dasar" required>
                        @error('nama_quiz')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_quiz" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi_quiz" name="deskripsi" rows="3"></textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jumlah_soal" class="form-label">Jumlah Soal</label>
                            <input type="number" class="form-control @error('jumlah_soal') is-invalid @enderror" id="jumlah_soal" name="jumlah_soal" placeholder="10" min="1" required>
                            @error('jumlah_soal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="durasi_menit_quiz" class="form-label">Durasi (menit)</label>
                            <input type="number" class="form-control @error('durasi_menit') is-invalid @enderror" id="durasi_menit_quiz" name="durasi_menit" placeholder="30" min="1" required>
                            @error('durasi_menit')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="urutan_quiz" class="form-label">Urutan</label>
                        <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan_quiz" name="urutan" placeholder="1" required>
                        @error('urutan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Quiz</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection