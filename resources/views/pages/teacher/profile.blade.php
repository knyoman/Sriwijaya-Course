@extends('layouts.app')
@section('title', 'Profil Pengajar')
@section('content')
<div class="d-flex">
    @include('components.sidebar-teacher')
    <main class="flex-fill p-4">
        <div class="mb-4">
            <h5 class="mb-1">Profil Saya</h5>
            <p class="text-muted small mb-0">Kelola informasi profil Anda</p>
        </div>

        <div class="row">
            <!-- Profile Info -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <img src="https://via.placeholder.com/120" alt="Avatar" class="rounded-circle mb-3" width="120">
                        <h6 class="fw-bold mb-1">{{ auth()->user()->nama }}</h6>
                        <p class="text-muted small mb-3">Pengajar</p>
                        <div class="mb-3">
                            <small class="text-muted">Email:</small>
                            <p class="small mb-0">{{ auth()->user()->email }}</p>
                        </div>
                        <button class="btn btn-sm btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalEditFoto">
                            <i class="fa-solid fa-camera me-1"></i>Ubah Foto
                        </button>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0">Informasi Profil</h6>
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditProfil">
                            <i class="fa-solid fa-edit me-1"></i>Edit
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <small class="text-muted">Nama Lengkap</small>
                                <p class="fw-bold">{{ auth()->user()->nama }}</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Email</small>
                                <p class="fw-bold">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <small class="text-muted">No. Telepon</small>
                                <p class="fw-bold">082123456789</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Keahlian</small>
                                <p class="fw-bold">Web Development, PHP</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <small class="text-muted">Alamat</small>
                                <p class="fw-bold">{{ auth()->user()->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="text-primary fs-4 mb-2">
                            <i class="fa-solid fa-book"></i>
                        </div>
                        <small class="text-muted d-block mb-2">Kursus Aktif</small>
                        <h5 class="fw-bold">3</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="text-success fs-4 mb-2">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <small class="text-muted d-block mb-2">Total Peserta</small>
                        <h5 class="fw-bold">28</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="text-warning fs-4 mb-2">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <small class="text-muted d-block mb-2">Rating</small>
                        <h5 class="fw-bold">4.8/5</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="text-danger fs-4 mb-2">
                            <i class="fa-solid fa-money-bill"></i>
                        </div>
                        <small class="text-muted d-block mb-2">Pendapatan</small>
                        <h5 class="fw-bold">Rp 2.5M</h5>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Modal Edit Foto -->
<div class="modal fade" id="modalEditFoto" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Foto</label>
                        <input type="file" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="modalEditProfil" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="tel" class="form-control" value="082123456789">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keahlian</label>
                        <input type="text" class="form-control" value="Web Development, PHP">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" rows="3">{{ auth()->user()->alamat }}</textarea>
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
@endsection