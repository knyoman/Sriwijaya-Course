@extends('layouts.app')

@section('title', 'Riwayat Pembayaran - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fw-bold">Riwayat Pembayaran</h1>
                <p class="text-muted">Daftar transaksi pembayaran Anda</p>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-sm align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:5%">No</th>
                            <th style="width:65%">Kursus</th>
                            <th style="width:20%" class="text-end text-nowrap">Jumlah</th>
                            <th style="width:10%" class="text-nowrap">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($payments->isEmpty())
                        <tr>
                            <td colspan="4">Belum ada riwayat pembayaran</td>
                        </tr>
                        @else
                        @foreach($payments as $key => $payment)
                        <tr>
                            <td class="align-middle">{{ $key + 1 }}</td>
                            <td>
                                <div class="text-truncate d-inline-block" style="max-width:360px;">{{ $payment->kursus_nama }}</div>
                            </td>
                            <td class="text-end text-nowrap">Rp {{ number_format($payment->harga, 0, ',', '.') }}</td>
                            <td class="text-nowrap">
                                <span class="badge bg-success">Lunas</span>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Footer cards removed per user request -->
        </div>
    </main>
</div>
@endsection