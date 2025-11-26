@extends('layouts.app')
@section('title', 'Riwayat Pembayaran Admin')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem;">
        <div class="container-fluid">
            <h5 class="mb-3">Riwayat Pembayaran</h5>
            @if($payments->isEmpty())
            <div class="alert alert-info">
                Belum ada riwayat pembayaran
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pembeli</th>
                            <th>Kursus</th>
                            <th>Metode Pembayaran</th>
                            <th>Tanggal Daftar</th>
                            <th class="text-end">Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $key => $payment)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $payment->pelajar_username }}</td>
                            <td>{{ $payment->kursus_nama }}</td>
                            <td>{{ $payment->metode_pembayaran }}</td>
                            <td>{{ $payment->tanggal_daftar }}</td>
                            <td class="text-end">Rp {{ number_format($payment->harga, 0, ',', '.') }}</td>
                            <td><span class="badge {{ strtolower($payment->status) == 'lunas' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $payment->status }}</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editPaymentModal{{ $key }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Payment Modal -->
                        <div class="modal fade" id="editPaymentModal{{ $key }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Data Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.payments.update', [$payment->id, $payment->student_id]) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Pembeli</label>
                                                <input type="text" class="form-control" value="{{ $payment->pelajar_username }}" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kursus</label>
                                                <input type="text" class="form-control" value="{{ $payment->kursus_nama }}" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Metode Pembayaran</label>
                                                <input type="text" name="metode_pembayaran" class="form-control" value="{{ $payment->metode_pembayaran }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Daftar</label>
                                                <input type="date" name="tanggal_daftar" class="form-control" value="{{ $payment->created_at ? $payment->created_at->format('Y-m-d') : '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Status Pembayaran</label>
                                                <select name="status_pembayaran" class="form-select">
                                                    <option value="pending" {{ strtolower($payment->status) != 'lunas' ? 'selected' : '' }}>Pending</option>
                                                    <option value="lunas" {{ strtolower($payment->status) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-end fw-bold">Total Transaksi:</td>
                            <td class="fw-bold text-end">{{ $totalTransactions }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-end fw-bold">Total Jumlah:</td>
                            <td colspan="2" class="fw-bold text-end">Rp {{ number_format($totalAmount, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @endif
        </div>
    </main>
</div>
@endsection