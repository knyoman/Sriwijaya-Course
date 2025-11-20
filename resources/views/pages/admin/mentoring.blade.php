@extends('layouts.app')
@section('title', 'Entry Jadwal Mentoring')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <h5 class="mb-4">Entry Jadwal Mentoring</h5>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div></div>
                <a href="{{ route('admin.mentoring.create') }}" class="btn btn-secondary btn-sm">+ Tambah Jadwal</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Pengajar</th>
                            <th>Tanggal Mentoring</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mentorings as $mentoring)
                        <tr>
                            <td>{{ $mentoring->pengajar->nama }}</td>
                            <td>{{ $mentoring->tanggal->format('d M Y') }} {{ $mentoring->jam }}</td>
                            <td>
                                <span class="badge {{ $mentoring->status === 'Sudah' ? 'bg-success' : 'bg-warning' }}">{{ $mentoring->status }}</span>
                            </td>
                            <td>
                                @if($mentoring->zoom_link)
                                <a href="{{ $mentoring->zoom_link }}" target="_blank" class="btn btn-info btn-sm me-2">Link Zoom</a>
                                @endif
                                <a href="{{ route('admin.mentoring.edit', $mentoring->id) }}" class="btn btn-secondary btn-sm me-2">Edit</a>
                                <form action="{{ route('admin.mentoring.destroy', $mentoring->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus jadwal ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada jadwal mentoring</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection