@extends('layouts.auth')

@section('title', 'Daftar - Kursus Sriwijaya')

@section('content')
<section class="register-section py-5" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary mb-2">Bergabunglah dengan Kami</h2>
                            <p class="text-muted">Daftar dan mulai perjalanan belajar Anda</p>
                        </div>

                        <!-- Form Register -->
                        <form action="{{ route('register.post') }}" method="POST">
                            @csrf

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                                <input
                                    type="text"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    placeholder="Masukkan nama lengkap"
                                    value="{{ old('name') }}"
                                    required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input
                                    type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    placeholder="Masukkan email Anda"
                                    value="{{ old('email') }}"
                                    required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input
                                    type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Masukkan password (minimal 8 karakter)"
                                    required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password</label>
                                <input
                                    type="password"
                                    class="form-control form-control-lg"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Konfirmasi password Anda"
                                    required>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="form-check mb-4">
                                <input
                                    class="form-check-input @error('terms') is-invalid @enderror"
                                    type="checkbox"
                                    id="terms"
                                    name="terms"
                                    required>
                                <label class="form-check-label" for="terms">
                                    Saya setuju dengan <a href="#" class="text-primary text-decoration-none">Syarat & Ketentuan</a>
                                </label>
                                @error('terms')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Register Button -->
                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold rounded-3 mb-3">
                                Daftar Sekarang
                            </button>
                        </form>

                        <!-- Link to Login -->
                        <div class="text-center mt-4">
                            <p class="text-muted">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">
                                    Masuk di sini
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection