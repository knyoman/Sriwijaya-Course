@extends('layouts.app')
@section('title', 'Entry Kursus - Pengajar')
@section('content')
<div class="d-flex">
    @include('components.sidebar-teacher')
    <main class="flex-fill p-4">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">Entry Kursus</h5>
                <p class="text-muted small mb-0">Kelola kursus yang Anda ajarkan</p>
            </div>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>Tambah Kursus Baru
            </a>
        </div>

        <!-- Courses Grid -->
        <div class="row">
            @forelse($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <!-- Course Image -->
                    <div style="height:160px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); position:relative; overflow:hidden; display:flex; align-items:center; justify-content:center;">
                        @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->nama }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                        <i class="fa-solid fa-image text-white" style="font-size:50px; opacity:0.5;"></i>
                        @endif
                    </div>

                    <!-- Course Info -->
                    <div class="card-body pb-2">
                        <h6 class="card-title fw-bold mb-2">{{ $course->nama }}</h6>
                        <p class="small text-muted mb-2">{{ Str::limit($course->deskripsi, 80) }}</p>
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fa-solid fa-users me-1"></i>{{ $course->jumlah_pelajar ?? 0 }} Peserta
                            </small>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="card-footer bg-white border-top d-grid gap-2">
                        <a href="{{ route('teacher.course-materials', $course->id) }}" class="btn btn-sm btn-outline-info">
                            <i class="fa-solid fa-book me-1"></i>Materi
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fa-solid fa-info-circle me-2"></i>Anda belum memiliki kursus. <a href="{{ route('admin.courses.create') }}">Buat kursus baru</a>
                </div>
            </div>
            @endforelse
        </div>
    </main>
</div>

<!-- Modal Tambah Kursus -->
<div class="modal fade" id="modalTambahKursus" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kursus Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama kursus" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" required>
                                <option>-- Pilih Kategori --</option>
                                <option>Teknologi</option>
                                <option>Bisnis</option>
                                <option>Desain</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Level</label>
                            <select class="form-select" required>
                                <option>-- Pilih Level --</option>
                                <option>Dasar</option>
                                <option>Menengah</option>
                                <option>Lanjutan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" rows="3" placeholder="Jelaskan tentang kursus ini" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" class="form-control" placeholder="50000" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kapasitas Peserta</label>
                            <input type="number" class="form-control" placeholder="30" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Kursus</label>
                        <input type="file" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Kursus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection