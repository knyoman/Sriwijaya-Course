@extends('layouts.app')

@section('title', 'Akun Profil - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem; padding-top: 70px;">
        <div class="container-fluid">
            <!-- Alert Messages -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Terjadi Kesalahan!</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="mb-4">
                <h1 class="fw-bold mb-1">
                    <i class="fas fa-user-circle me-2" style="color: #2563eb;"></i>Akun Profil
                </h1>
                <p class="text-muted">Kelola dan perbarui informasi akun Anda</p>
            </div>

            <div class="row">
                <!-- Card Profil Singkat -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                        <div class="card-body text-center py-5">
                            <div class="mb-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=random&color=fff&size=150"
                                    alt="Avatar" class="rounded-circle border-4" style="border-color: rgba(255,255,255,0.3);" width="120">
                            </div>
                            <h5 class="fw-bold mb-1">{{ auth()->user()->nama }}</h5>
                            <p class="opacity-75 small mb-0">{{ auth()->user()->email }}</p>
                            <hr class="opacity-25 my-3">
                            <div class="text-start">
                                <small class="d-block opacity-75"><i class="fas fa-id-card me-2"></i>Username: <strong>{{ auth()->user()->username }}</strong></small>
                                <small class="d-block opacity-75 mt-2"><i class="fas fa-graduation-cap me-2"></i>Peran: <strong class="text-uppercase">{{ auth()->user()->peran }}</strong></small>
                                <small class="d-block opacity-75 mt-2"><i class="fas fa-calendar me-2"></i>Bergabung: <strong>{{ auth()->user()->created_at->format('d M Y') }}</strong></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Informasi Pribadi -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
                            <i class="fas fa-user me-2" style="color: #2563eb; font-size: 1.2em;"></i>
                            <h5 class="fw-bold mb-0">Informasi Pribadi</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-500">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" value="{{ old('nama', auth()->user()->nama) }}" required>
                                        @error('nama') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-500">Username</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->username }}" disabled>
                                        <small class="text-muted">Username tidak dapat diubah</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-500">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-500">Nomor Telepon</label>
                                        <input type="tel" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                            name="nomor_telepon" value="{{ old('nomor_telepon', auth()->user()->nomor_telepon ?? '') }}"
                                            placeholder="08xx xxxx xxxx">
                                        @error('nomor_telepon') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-500">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            name="tanggal_lahir" value="{{ old('tanggal_lahir', auth()->user()->tanggal_lahir ?? '') }}">
                                        @error('tanggal_lahir') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-500">Jenis Kelamin</label>
                                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                            <option value="">-- Pilih --</option>
                                            <option value="laki-laki" {{ old('jenis_kelamin', auth()->user()->jenis_kelamin ?? '') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="perempuan" {{ old('jenis_kelamin', auth()->user()->jenis_kelamin ?? '') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-500">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" rows="3"
                                        name="alamat" placeholder="Masukkan alamat lengkap Anda">{{ old('alamat', auth()->user()->alamat ?? '') }}</textarea>
                                    @error('alamat') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary">
                                        <i class="fas fa-redo me-2"></i>Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Keamanan Akun -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
                            <i class="fas fa-lock me-2" style="color: #dc2626; font-size: 1.2em;"></i>
                            <h5 class="fw-bold mb-0">Keamanan Akun</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                <div>
                                    <h6 class="fw-bold mb-1">
                                        <i class="fas fa-key me-2"></i>Password
                                    </h6>
                                    <p class="text-muted small mb-0">Ubah password akun Anda secara berkala untuk keamanan maksimal</p>
                                </div>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <i class="fas fa-edit me-1"></i>Ubah Password
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
        <div class="modal-content border-0">
            <div class="modal-header bg-light border-0">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-key me-2"></i>Ubah Password
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.update-password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-500">Password Saat Ini</label>
                        <input type="password" class="form-control @error('password_lama') is-invalid @enderror"
                            name="password_lama" placeholder="Masukkan password saat ini" required>
                        @error('password_lama') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-500">Password Baru</label>
                        <input type="password" class="form-control @error('password_baru') is-invalid @enderror"
                            name="password_baru" placeholder="Masukkan password baru (min 8 karakter)" required>
                        @error('password_baru') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-500">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control @error('password_baru_confirmation') is-invalid @enderror"
                            name="password_baru_confirmation" placeholder="Konfirmasi password baru" required>
                        @error('password_baru_confirmation') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>
                    <div class="alert alert-info small mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Password harus minimal 8 karakter dan mengandung kombinasi huruf, angka, dan simbol
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-save me-2"></i>Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-label {
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
        padding: 0.6rem 1.2rem;
    }

    .btn-primary {
        background-color: #2563eb;
        border: none;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }

    .btn-danger {
        background-color: #dc2626;
        border: none;
    }

    .btn-danger:hover {
        background-color: #b91c1c;
    }

    .card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .card-header {
        border-bottom: 2px solid #f3f4f6;
    }

    .modal-content {
        border-radius: 12px;
    }
</style>
@endsection