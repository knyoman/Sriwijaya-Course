@extends('layouts.app')
@section('title', 'Riwayat Pembayaran Admin')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <h5 class="mb-3">Riwayat Pembayaran</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pembeli</th>
                            <th>Kursus</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=1; $i<=6; $i++)
                            <tr>
                            <td>{{ $i }}</td>
                            <td>Nama Pelajar {{ $i }}</td>
                            <td>Kursus {{ $i }}</td>
                            <td>Rp 50.000</td>
                            <td><span class="badge bg-success">Lunas</span></td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection