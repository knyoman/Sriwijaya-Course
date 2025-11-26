@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem;">
        <div class="w-100">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="h3 fw-bold mb-4">Dashboard Admin</h1>
                <p class="text-muted">Selamat datang kembali, Administrator!</p>
            </div>

            <!-- Statistics Cards Row -->
            <div class="row g-3 mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-4 text-center" style="border: none; border-radius: 8px; border-left: 4px solid #007bff;">
                        <div class="fw-bold small text-muted mb-2">Total Pengguna</div>
                        <div class="display-5 mt-2 fw-bold text-primary">{{ $totalUsers }}</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-4 text-center" style="border: none; border-radius: 8px; border-left: 4px solid #28a745;">
                        <div class="fw-bold small text-muted mb-2">Pengajar</div>
                        <div class="display-5 mt-2 fw-bold text-success">{{ $totalTeachers }}</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-4 text-center" style="border: none; border-radius: 8px; border-left: 4px solid #ffc107;">
                        <div class="fw-bold small text-muted mb-2">Pelajar</div>
                        <div class="display-5 mt-2 fw-bold text-warning">{{ $totalStudents }}</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-4 text-center" style="border: none; border-radius: 8px; border-left: 4px solid #dc3545;">
                        <div class="fw-bold small text-muted mb-2">Total Kursus</div>
                        <div class="display-5 mt-2 fw-bold text-danger">{{ $totalCourses }}</div>
                    </div>
                </div>
            </div>

            <!-- Activity Log Section -->
            <div class="card shadow-sm" style="border: none; border-radius: 8px;">
                <div class="card-header bg-white border-bottom p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-bold">
                            <i class="fas fa-history me-2 text-info"></i>Log Aktivitas Pengguna
                        </h5>
                        <a href="{{ route('admin.activity-logs') }}" class="btn btn-sm btn-outline-primary">
                            Lihat Semua
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if($activityLogs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Pengguna</th>
                                    <th>Tipe Aktivitas</th>
                                    <th>Deskripsi</th>
                                    <th>Model</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activityLogs as $log)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2" style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                {{ substr($log->user->nama ?? $log->user->username, 0, 1) }}
                                            </div>
                                            <div>
                                                <strong>{{ $log->user->nama ?? $log->user->username }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $log->user->peran }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @switch($log->activity_type)
                                        @case('login')
                                        <span class="badge bg-success">Login</span>
                                        @break
                                        @case('logout')
                                        <span class="badge bg-secondary">Logout</span>
                                        @break
                                        @case('create')
                                        <span class="badge bg-primary">Buat</span>
                                        @break
                                        @case('update')
                                        <span class="badge bg-info">Update</span>
                                        @break
                                        @case('delete')
                                        <span class="badge bg-danger">Hapus</span>
                                        @break
                                        @case('view')
                                        <span class="badge bg-secondary">Lihat</span>
                                        @break
                                        @default
                                        <span class="badge bg-dark">{{ ucfirst($log->activity_type) }}</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $log->description }}</td>
                                    <td>
                                        @if($log->action_model)
                                        <span class="badge bg-light text-dark">{{ $log->action_model }}</span>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $log->created_at->format('d/m/Y H:i') }}
                                            <br>
                                            {{ $log->created_at->diffForHumans() }}
                                        </small>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada aktivitas yang tercatat</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">Belum ada log aktivitas yang tersedia</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>

<style>
    .avatar {
        font-size: 14px;
    }

    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }

    .badge {
        font-size: 12px;
        padding: 0.4rem 0.6rem;
    }
</style>
@endsection