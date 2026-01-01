@extends('layouts.app')

@section('title', 'Submissions - Pengajar')

@section('content')
<div class="d-flex">
    @include('components.sidebar-teacher')
    <main style="margin-left: 250px; padding-top: 70px;" class="flex-fill p-4">
        <div class="mb-4">
            <a href="{{ route('teacher.course-materials', $course->id) }}" class="text-decoration-none text-muted me-2">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h5 class="mb-1">Submissions - {{ $course->nama }} @if(config('app.debug')) <span class="badge bg-danger ms-2">MODIFIED</span> @endif</h5>
                <p class="text-muted small mb-0">Daftar tugas yang dikirimkan oleh pelajar</p>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Materi</th>
                            <th>Pelajar</th>
                            <th>File</th>
                            <th>Nilai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $i => $s)
                        <tr>
                            <td style="width:50px;">{{ $i+1 }}</td>
                            <td style="min-width:240px;">{{ Str::limit($s->materi->judul_materi, 60) }}</td>
                            <td style="min-width:160px;">{{ $s->pelajar->nama }}</td>
                            <td><a href="{{ asset('storage/' . $s->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a></td>
                            <td style="width:80px; text-align:center;">{{ $s->nilai ?? '-' }}</td>
                            <td style="width:110px; text-align:center;"><span class="badge bg-{{ $s->status==='lulus' ? 'success' : ($s->status==='tidak_lulus' ? 'danger' : 'secondary') }}">{{ ucfirst($s->status) }}</span></td>
                            <td style="width:360px;">
                                <form action="{{ route('teacher.submission.grade', $s->id) }}" method="POST" class="submission-form">
                                    @csrf
                                    <div class="mb-2">
                                        <textarea name="komentar" class="form-control form-control-sm" rows="2" placeholder="Tulis komentar pengajar...">{{ $s->komentar ?? '' }}</textarea>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center">
                                        <input type="number" name="nilai" class="form-control form-control-sm" placeholder="Nilai" style="width:100px;" value="{{ $s->nilai ?? '' }}">
                                        <select name="status" class="form-select form-select-sm" style="width:140px;">
                                            <option value="lulus" {{ $s->status === 'lulus' ? 'selected' : '' }}>Lulus</option>
                                            <option value="tidak_lulus" {{ $s->status === 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                                            <option value="menunggu" {{ $s->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada submission</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection

<style>
    .submission-form .form-control-sm {
        font-size: .85rem;
    }

    .submission-form .btn-sm {
        padding: .35rem .6rem;
    }

    @media (max-width: 768px) {
        .submission-form .d-flex {
            flex-direction: column !important;
        }

        .submission-form .d-flex .btn {
            width: 100%;
        }
    }
</style>