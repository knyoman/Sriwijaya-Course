@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 56px - 4rem);">
            <div class="w-100" style="max-width: 800px;">
                <div class="row g-4">
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm p-4 text-center" style="border: none; border-radius: 8px;">
                            <div class="fw-bold small text-muted">Jumlah Pengajar</div>
                            <div class="display-5 mt-3 fw-bold">5</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm p-4 text-center" style="border: none; border-radius: 8px;">
                            <div class="fw-bold small text-muted">Jumlah Pelajar</div>
                            <div class="display-5 mt-3 fw-bold">10</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm p-4 text-center" style="border: none; border-radius: 8px;">
                            <div class="fw-bold small text-muted">Jumlah Kursus</div>
                            <div class="display-5 mt-3 fw-bold">11</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection