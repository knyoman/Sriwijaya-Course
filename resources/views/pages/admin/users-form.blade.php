@extends('layouts.app')
@section('title', 'Tambah/Edit Pengguna')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <h5 class="mb-4">{{ isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna' }}</h5>

            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', isset($user) ? $user->username : '') }}" required>
                                    @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', isset($user) ? $user->nama : '') }}" required>
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="peran" class="form-label">Peran</label>
                                    <select class="form-control @error('peran') is-invalid @enderror" id="peran" name="peran" required>
                                        <option value="">Pilih Peran</option>
                                        <option value="admin" {{ old('peran', isset($user) ? $user->peran : '') === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="pengajar" {{ old('peran', isset($user) ? $user->peran : '') === 'pengajar' ? 'selected' : '' }}>Pengajar</option>
                                        <option value="pelajar" {{ old('peran', isset($user) ? $user->peran : '') === 'pelajar' ? 'selected' : '' }}>Pelajar</option>
                                    </select>
                                    @error('peran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', isset($user) ? $user->alamat : '') }}</textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if(!isset($user))
                                <div class="mb-3">
                                    <label for="kata_sandi" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('kata_sandi') is-invalid @enderror" id="kata_sandi" name="kata_sandi" required>
                                    @error('kata_sandi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                @endif

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update' : 'Simpan' }}</button>
                                    <a href="{{ route('admin.users') }}" class="btn btn-secondary">Batal</a>
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