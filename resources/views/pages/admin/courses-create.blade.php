@extends('layouts.app')
@section('title', isset($course) ? 'Edit Kursus' : 'Tambah Kursus')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem;">
        <div class="container-fluid">
            <h5 class="mb-4">{{ isset($course) ? 'Edit Kursus' : 'Tambah Kursus Baru' }}</h5>

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ isset($course) ? route('admin.courses.update', $course->id) : route('admin.courses.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Kursus</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', isset($course) ? $course->nama : '') }}" required>
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi Kursus</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', isset($course) ? $course->deskripsi : '') }}</textarea>
                                    @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="harga" class="form-label">Harga (Rp)</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" step="0.01" value="{{ old('harga', isset($course) ? $course->harga : '') }}" required>
                                        @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pengajar_id" class="form-label">Pengajar</label>
                                        <select class="form-control @error('pengajar_id') is-invalid @enderror" id="pengajar_id" name="pengajar_id" required>
                                            <option value="">Pilih Pengajar</option>
                                            @foreach($pengajars as $pengajar)
                                            <option value="{{ $pengajar->id }}" {{ old('pengajar_id', isset($course) ? $course->pengajar_id : '') == $pengajar->id ? 'selected' : '' }}>{{ $pengajar->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('pengajar_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="durasi_jam" class="form-label">Durasi (Jam)</label>
                                        <input type="number" class="form-control @error('durasi_jam') is-invalid @enderror" id="durasi_jam" name="durasi_jam" value="{{ old('durasi_jam', isset($course) ? $course->durasi_jam : '') }}" required>
                                        @error('durasi_jam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                            <option value="draft" {{ old('status', isset($course) ? $course->status : '') === 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ old('status', isset($course) ? $course->status : '') === 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="archived" {{ old('status', isset($course) ? $course->status : '') === 'archived' ? 'selected' : '' }}>Archived</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">URL Gambar Kursus</label>
                                    <input type="url" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="https://example.com/image.jpg" value="{{ old('image', isset($course) ? $course->image : '') }}">
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="konten" class="form-label">Konten/Materi (opsional)</label>
                                    <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="4">{{ old('konten', isset($course) ? $course->konten : '') }}</textarea>
                                    @error('konten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">{{ isset($course) ? 'Update Kursus' : 'Simpan Kursus' }}</button>
                                    <a href="{{ route('admin.courses') }}" class="btn btn-secondary">Batal</a>
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