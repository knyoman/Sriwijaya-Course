@extends('layouts.app')
@section('title', 'Riwayat Pembayaran Admin')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
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
                            <th class="text-end">Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $key => $payment)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $payment->pelajar_username }}</td>
                            <td>{{ $payment->kursus_nama }}</td>
                            <td class="text-end">Rp {{ number_format($payment->harga, 0, ',', '.') }}</td>
                            <td><span class="badge bg-success">{{ $payment->status }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total Transaksi:</td>
                            <td class="fw-bold text-end">{{ $totalTransactions }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total Jumlah:</td>
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