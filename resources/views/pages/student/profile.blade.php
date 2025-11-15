@extends('layouts.app')

@section('title', 'Akun Profil - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fw-bold">Akun Profil</h1>
                <p class="text-muted">Kelola informasi akun Anda</p>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <img src="https://via.placeholder.com/150" alt="Avatar" class="rounded-circle mb-3" width="120">
                            <h5 class="fw-bold">{{ auth()->user()->nama }}</h5>
                            <p class="text-muted mb-3">{{ auth()->user()->email }}</p>
                            <button class="btn btn-primary btn-sm w-100 mb-2">Ubah Foto Profil</button>
                            <button class="btn btn-outline-secondary btn-sm w-100">Hapus Foto</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0">Informasi Pribadi</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->nama }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->username }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" value="08123456789">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" value="1999-05-15">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-select">
                                            <option selected>Laki-laki</option>
                                            <option>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" rows="3">Jl. Contoh No. 123, Kota, Provinsi</textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <button type="reset" class="btn btn-outline-secondary">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0">Keamanan Akun</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h6 class="fw-bold mb-2">Password</h6>
                                <p class="text-muted small mb-3">Ubah password akun Anda secara berkala untuk keamanan</p>
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <i class="fa-solid fa-key me-2"></i> Ubah Password
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" class="form-control" placeholder="Masukkan password lama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" class="form-control" placeholder="Masukkan password baru">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" placeholder="Konfirmasi password baru">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Ubah Password</button>
            </div>
        </div>
    </div>
</div>
@endsection