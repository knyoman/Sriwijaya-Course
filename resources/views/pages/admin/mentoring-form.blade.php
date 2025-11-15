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
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ isset($mentoring) ? route('admin.mentoring.update', $mentoring['id']) : route('admin.mentoring.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="pengajar" class="form-label">Nama Pengajar</label>
                                    <input type="text" class="form-control" id="pengajar" name="pengajar" value="{{ isset($mentoring) ? $mentoring['pengajar'] : '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Mentoring</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ isset($mentoring) ? $mentoring['tanggal'] : '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jam" class="form-label">Jam Mentoring</label>
                                    <input type="time" class="form-control" id="jam" name="jam" value="{{ isset($mentoring) ? $mentoring['jam'] : '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Belum" {{ isset($mentoring) && $mentoring['status'] === 'Belum' ? 'selected' : '' }}>Belum</option>
                                        <option value="Sudah" {{ isset($mentoring) && $mentoring['status'] === 'Sudah' ? 'selected' : '' }}>Sudah</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="zoom_link" class="form-label">Link Zoom</label>
                                    <input type="url" class="form-control" id="zoom_link" name="zoom_link" placeholder="https://zoom.us/j/..." value="{{ isset($mentoring) ? $mentoring['zoom_link'] : '' }}" required>
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