@extends('layouts.auth')

@section('title', 'Login - Kursus Sriwijaya')

@section('content')
<section class="login-section py-5" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary mb-2">Selamat Datang Kembali</h2>
                            <p class="text-muted">Masuk ke akun Sriwijaya Course Anda</p>
                        </div>

                        <!-- Form Login -->
                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf

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
                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input
                                    type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Masukkan password Anda"
                                    required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-4">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="remember"
                                    name="remember">
                                <label class="form-check-label" for="remember">
                                    Ingat saya
                                </label>
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold rounded-3 mb-3">
                                Masuk
                            </button>
                        </form>

                        <!-- Link to Register -->
                        <div class="text-center mt-4">
                            <p class="text-muted">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">
                                    Daftar di sini
                                </a>
                            </p>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="text-center">
                            <a href="#" class="text-primary text-decoration-none small">
                                Lupa password?
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection