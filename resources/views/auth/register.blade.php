{{-- filepath: c:\Users\acer\Desktop\KursusSriwijaya\resources\views\auth\register.blade.php --}}
@extends('layouts.auth')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="mb-2">Bergabunglah dengan Kami</h2>
            <p class="text-muted mb-4">Silakan isi data untuk membuat akun baru.</p>
        </div>
        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <div class="form-group mb-3">
                <label for="username" class="form-label">Username</label>
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>
                @error('username') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <div class="form-group mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required>
                @error('nama') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <div class="form-group mb-3">
                <label for="peran" class="form-label">Peran</label>
                <select id="peran" name="peran" class="form-control @error('peran') is-invalid @enderror" required>
                    <option value="">Pilih peran</option>
                    <option value="pelajar" {{ old('peran') == 'pelajar' ? 'selected' : '' }}>Pelajar</option>
                    <option value="pengajar" {{ old('peran') == 'pengajar' ? 'selected' : '' }}>Pengajar</option>
                    <option value="admin" {{ old('peran') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('peran') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <div class="form-group mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat') }}</textarea>
                @error('alamat') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <div class="form-group mb-4">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
        </form>
        <div class="mt-3 text-center">
            <small>Sudah punya akun? <a href="{{ route('login') }}">Login</a></small>
        </div>
    </div>
</div>

<style>
    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
    }

    .auth-card {
        background: #fff;
        padding: 2.5rem 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.07);
        width: 100%;
        max-width: 400px;
    }

    .auth-header h2 {
        font-weight: 700;
    }

    .form-label {
        font-weight: 500;
    }

    .btn-primary {
        background: #2563eb;
        border: none;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .invalid-feedback {
        color: #e11d48;
        font-size: 0.9em;
    }
</style>
@endsection