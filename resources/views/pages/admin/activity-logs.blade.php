@extends('layouts.app')
@section('title', 'Log Aktivitas')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem;">
        <div class="w-100">
            <!-- Header -->
            <div class="mb-4">
                <h1 class="h3 fw-bold mb-2">Log Aktivitas Pengguna</h1>
                <p class="text-muted">Pantau seluruh aktivitas yang dilakukan oleh pengguna dalam sistem</p>
            </div>

            <!-- Filter Section -->
            <div class="card shadow-sm mb-4" style="border: none; border-radius: 8px;">
                <div class="card-body p-4">
                    <form action="{{ route('admin.activity-logs') }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="user_id" class="form-label">Cari Pengguna</label>
                            <input
                                type="text"
                                class="form-control"
                                id="search_user"
                                name="search_user"
                                placeholder="Nama atau username..."
                                value="{{ request('search_user') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="activity_type" class="form-label">Tipe Aktivitas</label>
                            <select class="form-select" id="activity_type" name="activity_type">
                                <option value="">Semua Tipe</option>
                                <option value="login" {{ request('activity_type') == 'login' ? 'selected' : '' }}>Login</option>
                                <option value="logout" {{ request('activity_type') == 'logout' ? 'selected' : '' }}>Logout</option>
                                <option value="create" {{ request('activity_type') == 'create' ? 'selected' : '' }}>Buat</option>
                                <option value="update" {{ request('activity_type') == 'update' ? 'selected' : '' }}>Update</option>
                                <option value="delete" {{ request('activity_type') == 'delete' ? 'selected' : '' }}>Hapus</option>
                                <option value="view" {{ request('activity_type') == 'view' ? 'selected' : '' }}>Lihat</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="date_from" class="form-label">Dari Tanggal</label>
                            <input
                                type="date"
                                class="form-control"
                                id="date_from"
                                name="date_from"
                                value="{{ request('date_from') }}">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                            <a href="{{ route('admin.activity-logs') }}" class="btn btn-secondary">
                                <i class="fas fa-redo me-2"></i>Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Activity Logs Table -->
            <div class="card shadow-sm" style="border: none; border-radius: 8px;">
                <div class="card-header bg-white border-bottom p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-bold">
                            <i class="fas fa-list me-2 text-info"></i>Daftar Aktivitas
                        </h5>
                        <span class="badge bg-secondary">Total: {{ $activityLogs->total() }}</span>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if($activityLogs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Pengguna</th>
                                    <th>Tipe Aktivitas</th>
                                    <th>Deskripsi</th>
                                    <th>Model</th>
                                    <th>IP Address</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activityLogs as $index => $log)
                                <tr>
                                    <td class="ps-4">{{ ($activityLogs->currentPage() - 1) * $activityLogs->perPage() + $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2" style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 14px;">
                                                {{ substr($log->user->nama ?? $log->user->username, 0, 1) }}
                                            </div>
                                            <div>
                                                <strong>{{ $log->user->nama ?? $log->user->username }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    @switch($log->user->peran)
                                                    @case('pelajar')
                                                    <span class="badge bg-warning text-dark">Pelajar</span>
                                                    @break
                                                    @case('pengajar')
                                                    <span class="badge bg-info">Pengajar</span>
                                                    @break
                                                    @case('admin')
                                                    <span class="badge bg-danger">Admin</span>
                                                    @break
                                                    @default
                                                    {{ $log->user->peran }}
                                                    @endswitch
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @switch($log->activity_type)
                                        @case('login')
                                        <span class="badge bg-success">
                                            <i class="fas fa-sign-in-alt me-1"></i>Login
                                        </span>
                                        @break
                                        @case('logout')
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                                        </span>
                                        @break
                                        @case('create')
                                        <span class="badge bg-primary">
                                            <i class="fas fa-plus me-1"></i>Buat
                                        </span>
                                        @break
                                        @case('update')
                                        <span class="badge bg-info">
                                            <i class="fas fa-edit me-1"></i>Update
                                        </span>
                                        @break
                                        @case('delete')
                                        <span class="badge bg-danger">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </span>
                                        @break
                                        @case('view')
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-eye me-1"></i>Lihat
                                        </span>
                                        @break
                                        @default
                                        <span class="badge bg-dark">{{ ucfirst($log->activity_type) }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <small>{{ $log->description }}</small>
                                    </td>
                                    <td>
                                        @if($log->action_model)
                                        <span class="badge bg-light text-dark">{{ $log->action_model }}</span>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $log->ip_address ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <strong>{{ $log->created_at->format('d/m/Y H:i:s') }}</strong>
                                            <br>
                                            {{ $log->created_at->diffForHumans() }}
                                        </small>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                                        <p class="text-muted mt-3">Belum ada log aktivitas yang tersedia</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4 pb-4">
                        {{ $activityLogs->links() }}
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
        font-size: 11px;
        padding: 0.35rem 0.5rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>
@endsection