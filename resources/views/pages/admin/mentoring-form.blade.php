@extends('layouts.app')
@section('title', 'Tambah/Edit Jadwal Mentoring')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <h5 class="mb-4">{{ isset($mentoring) ? 'Edit Jadwal Mentoring' : 'Tambah Jadwal Mentoring' }}</h5>

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ isset($mentoring) ? route('admin.mentoring.update', $mentoring->id) : route('admin.mentoring.store') }}" method="POST">
                                @csrf
                                @if(isset($mentoring))
                                @method('POST')
                                @endif

                                <!-- Informasi Dasar -->
                                <h6 class="mb-3 border-bottom pb-2">Informasi Dasar</h6>

                                <div class="mb-3">
                                    <label for="pengajar_id" class="form-label">Nama Pengajar <span class="text-danger">*</span></label>
                                    <select class="form-control @error('pengajar_id') is-invalid @enderror" id="pengajar_id" name="pengajar_id" required>
                                        <option value="">Pilih Pengajar</option>
                                        @foreach($pengajars as $pengajar)
                                        <option value="{{ $pengajar->id }}" {{ isset($mentoring) && $mentoring->pengajar_id === $pengajar->id ? 'selected' : '' }}>{{ $pengajar->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('pengajar_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kursus_id" class="form-label">Kursus <span class="text-danger">*</span></label>
                                    <select class="form-control @error('kursus_id') is-invalid @enderror" id="kursus_id" name="kursus_id" required>
                                        <option value="">Pilih Kursus</option>
                                        @foreach($kursuses as $kursus)
                                        <option value="{{ $kursus->id }}" {{ isset($mentoring) && $mentoring->kursus_id === $kursus->id ? 'selected' : '' }}>{{ $kursus->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kursus_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="topik" class="form-label">Topik Mentoring <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('topik') is-invalid @enderror" id="topik" name="topik" placeholder="Contoh: Web Development Basics" value="{{ isset($mentoring) ? $mentoring->topik : '' }}" required>
                                    @error('topik')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tanggal" class="form-label">Tanggal Mentoring <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ isset($mentoring) ? $mentoring->tanggal->format('Y-m-d') : '' }}" required>
                                            @error('tanggal')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="jam" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control @error('jam') is-invalid @enderror" id="jam" name="jam" value="{{ isset($mentoring) ? $mentoring->jam : '' }}" required>
                                            @error('jam')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="durasi" class="form-label">Durasi (menit) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('durasi') is-invalid @enderror" id="durasi" name="durasi" placeholder="Contoh: 60" value="{{ isset($mentoring) ? $mentoring->durasi : '' }}" required>
                                    @error('durasi')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <!-- Status dan Link -->
                                <h6 class="mb-3 border-bottom pb-2 mt-4">Status dan Akses</h6>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status Mentoring <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Belum" {{ isset($mentoring) && $mentoring->status === 'Belum' ? 'selected' : '' }}>Belum Dimulai</option>
                                        <option value="Sedang Berlangsung" {{ isset($mentoring) && $mentoring->status === 'Sedang Berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                        <option value="Sudah" {{ isset($mentoring) && $mentoring->status === 'Sudah' ? 'selected' : '' }}>Sudah Selesai</option>
                                    </select>
                                    @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="zoom_link" class="form-label">Link Zoom</label>
                                    <input type="url" class="form-control @error('zoom_link') is-invalid @enderror" id="zoom_link" name="zoom_link" placeholder="https://zoom.us/j/..." value="{{ isset($mentoring) ? $mentoring->zoom_link : '' }}">
                                    @error('zoom_link')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">{{ isset($mentoring) ? 'Update' : 'Simpan' }}</button>
                                    <a href="{{ route('admin.mentoring') }}" class="btn btn-secondary">Batal</a>
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