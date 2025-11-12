@extends('layouts.app')

@section('title', 'Kursus - Kursus Sriwijaya')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">Semua Kursus Kami</h1>
    <div class="row g-4">
        @for ($i = 1; $i <= 6; $i++)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Course">
                    <div class="card-body">
                        <h5 class="card-title">Kursus {{ $i }}</h5>
                        <p class="card-text">Deskripsi singkat tentang kursus ini.</p>
                        <p class="text-danger fw-bold">Rp 299.000</p>
                        <button class="btn btn-primary w-100">Daftar Sekarang</button>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection