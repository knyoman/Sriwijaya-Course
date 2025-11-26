@extends('layouts.app')
@section('title', 'Sertifikat')
@section('content')
@include('components.navbar-admin')
<div class="d-flex">
    @include('components.sidebar-admin')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem;">
        <div class="container-fluid">
            <h5 class="mb-3">Sertifikat</h5>
            <div class="row">
                @for($i=0;$i<6;$i++)
                    <div class="col-md-4 mb-4">
                    <div class="card shadow-sm p-3">
                        <div class="fw-bold">Sertifikat Kursus {{ $i+1 }}</div>
                        <div class="small text-muted mb-2">Nama Pelajar</div>
                        <a class="btn btn-outline-primary btn-sm">Lihat</a>
                    </div>
            </div>
            @endfor
        </div>
</div>
</main>
</div>
@endsection