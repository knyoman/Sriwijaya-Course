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
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kursus</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Web Development Basics</td>
                            <td>15 Agustus 2024</td>
                            <td>Rp. 299.000</td>
                            <td>Transfer Bank</td>
                            <td><span class="badge bg-success">Lunas</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">Bukti</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>PHP Advanced</td>
                            <td>20 September 2024</td>
                            <td>Rp. 399.000</td>
                            <td>E-Wallet</td>
                            <td><span class="badge bg-success">Lunas</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">Bukti</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>React JS</td>
                            <td>10 Oktober 2024</td>
                            <td>Rp. 449.000</td>
                            <td>Kartu Kredit</td>
                            <td><span class="badge bg-success">Lunas</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">Bukti</button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Python Data Science</td>
                            <td>05 November 2024</td>
                            <td>Rp. 499.000</td>
                            <td>Transfer Bank</td>
                            <td><span class="badge bg-success">Lunas</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">Bukti</button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Laravel</td>
                            <td>18 November 2024</td>
                            <td>Rp. 349.000</td>
                            <td>E-Wallet</td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">Bukti</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Total Pembayaran</h6>
                            <h3 class="fw-bold text-primary">Rp. 2.095.000</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Pembayaran Lunas</h6>
                            <h3 class="fw-bold text-success">Rp. 1.746.000</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Menunggu Konfirmasi</h6>
                            <h3 class="fw-bold text-warning">Rp. 349.000</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection