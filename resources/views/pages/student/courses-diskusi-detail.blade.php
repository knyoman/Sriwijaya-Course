@extends('layouts.app')
@section('title', 'Diskusi - ' . $diskusi->judul)
@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem; padding-top: 70px;">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5>{{ $diskusi->judul }}</h5>
                    <small class="text-muted">{{ $course->nama }}</small>
                </div>
                <a href="{{ route('student.courses.diskusi.index', $course->id) }}" class="btn btn-secondary btn-sm">Kembali ke Diskusi</a>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <!-- Chat/Balasan Section -->
                    <div class="card shadow-sm" style="height: 600px; display: flex; flex-direction: column;">
                        <div class="card-header bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">{{ $diskusi->judul }}</h6>
                                    <small class="text-muted">{{ $diskusi->jumlah_balasan }} balasan</small>
                                </div>
                            </div>
                        </div>

                        <!-- Chat Messages -->
                        <div class="card-body" style="flex: 1; overflow-y: auto; background-color: #f8f9fa;">
                            <!-- Topik Awal -->
                            <div class="mb-4">
                                <div class="d-flex mb-2">
                                    <strong>{{ $diskusi->pembuat->nama }}</strong>
                                    <small class="text-muted ms-2">{{ $diskusi->created_at->format('d M Y H:i') }}</small>
                                </div>
                                <div class="bg-white p-3 rounded border">
                                    {{ $diskusi->konten }}
                                </div>
                            </div>

                            <hr>

                            <!-- Balasan -->
                            @foreach($balasan as $reply)
                            <div class="mb-3">
                                <div class="d-flex mb-2 align-items-center justify-content-between">
                                    <div>
                                        <strong>{{ $reply->pembuat->nama }}</strong>
                                        <small class="text-muted ms-2">{{ $reply->created_at->format('d M Y H:i') }}</small>
                                    </div>
                                    @if(auth()->id() === $reply->pembuat_id)
                                    <form action="{{ route('student.courses.diskusi.balasan.destroy', [$course->id, $diskusi->id, $reply->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus balasan?')">Hapus</button>
                                    </form>
                                    @endif
                                </div>
                                <div class="bg-white p-3 rounded border">
                                    {{ $reply->konten }}
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Input Balasan -->
                        <div class="card-footer bg-white border-top">
                            <form action="{{ route('student.courses.diskusi.balasan.store', [$course->id, $diskusi->id]) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <textarea class="form-control @error('konten') is-invalid @enderror" name="konten" rows="2" placeholder="Tulis balasan Anda..." required></textarea>
                                    <button class="btn btn-primary" type="submit">Kirim</button>
                                </div>
                                @error('konten')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h6 class="mb-0">Informasi Diskusi</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block">Dibuat oleh</small>
                                <strong>{{ $diskusi->pembuat->nama }}</strong>
                                <br>
                                <small class="text-muted">{{ $diskusi->pembuat->email }}</small>
                            </div>

                            <div class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block">Tanggal Dibuat</small>
                                <strong>{{ $diskusi->created_at->format('d M Y H:i') }}</strong>
                            </div>

                            <div class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block">Total Balasan</small>
                                <strong>{{ $diskusi->jumlah_balasan }}</strong>
                            </div>

                            <div class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block">Peserta Aktif</small>
                                <strong>{{ $peserta_aktif }}</strong>
                            </div>

                            <h6 class="mt-4 mb-3">Daftar Peserta</h6>
                            <div style="max-height: 200px; overflow-y: auto;">
                                @foreach($peserta_list as $peserta)
                                <div class="mb-2 pb-2 border-bottom">
                                    <small><strong>{{ $peserta->pembuat->nama }}</strong></small>
                                    <br>
                                    <small class="text-muted">{{ $peserta->pembuat->email }}</small>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection