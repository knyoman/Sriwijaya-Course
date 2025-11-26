@extends('layouts.app')
@section('title', 'Edit Jadwal Mentoring - Pengajar')
@section('content')
<div class="d-flex">
    @include('components.sidebar-teacher')
    <main style="flex: 1; padding: 2rem; width: 100%; margin-left: 250px; padding-top: 70px;">
        <div class="container-fluid">
            <a href="{{ route('teacher.mentoring') }}" class="btn btn-outline-secondary btn-sm mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i>Kembali
            </a>
            <h5 class="mb-4">Edit Jadwal Mentoring</h5>

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <!-- Info Mentoring yang Read-Only -->
                            <h6 class="mb-3 border-bottom pb-2">Informasi Mentoring</h6>

                            <div class="mb-3">
                                <label class="form-label text-muted">Topik</label>
                                <p class="form-control-plaintext">{{ $mentoring->topik }}</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Tanggal</label>
                                        <p class="form-control-plaintext">{{ $mentoring->tanggal->locale('id')->translatedFormat('l, d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Jam Mulai</label>
                                        <p class="form-control-plaintext">{{ $mentoring ? \Carbon\Carbon::parse($mentoring->jam)->format('H:i') : '' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted">Durasi</label>
                                <p class="form-control-plaintext">{{ $mentoring->durasi }} menit</p>
                            </div>

                            <!-- Form Edit - Hanya Status dan Zoom Link -->
                            <form action="{{ route('teacher.mentoring.update', $mentoring->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <h6 class="mb-3 border-bottom pb-2 mt-4">Edit Status & Akses</h6>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status Mentoring <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Belum" {{ $mentoring->status === 'Belum' ? 'selected' : '' }}>Belum Dimulai</option>
                                        <option value="Sedang Berlangsung" {{ $mentoring->status === 'Sedang Berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                        <option value="Sudah" {{ $mentoring->status === 'Sudah' ? 'selected' : '' }}>Sudah Selesai</option>
                                    </select>
                                    @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="zoom_link" class="form-label">Link Zoom</label>
                                    <input type="url" class="form-control @error('zoom_link') is-invalid @enderror" id="zoom_link" name="zoom_link" placeholder="https://zoom.us/j/..." value="{{ $mentoring->zoom_link }}">
                                    @error('zoom_link')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('teacher.mentoring') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection