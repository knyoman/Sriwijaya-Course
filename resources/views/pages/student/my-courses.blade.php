@extends('layouts.app')

@section('title', 'My Kursus - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fw-bold">Kursus Saya</h1>
                <p class="text-muted">Daftar kursus yang sedang Anda ikuti</p>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Web Development Basics</h5>
                            <p class="card-text text-muted">Belajar dasar-dasar web development</p>
                            <div class="mb-3">
                                <small class="d-block mb-2 text-muted">Progress: 70%</small>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-primary" style="width: 70%"></div>
                                </div>
                            </div>
                            <small class="text-muted d-block mb-2">Instruktur: Doni Santoso</small>
                            <button class="btn btn-sm btn-outline-primary">Lanjut Belajar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">PHP Advanced</h5>
                            <p class="card-text text-muted">Master PHP untuk backend development</p>
                            <div class="mb-3">
                                <small class="d-block mb-2 text-muted">Progress: 50%</small>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 50%"></div>
                                </div>
                            </div>
                            <small class="text-muted d-block mb-2">Instruktur: Budi Santoso</small>
                            <button class="btn btn-sm btn-outline-primary">Lanjut Belajar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">React JS</h5>
                            <p class="card-text text-muted">Framework JavaScript modern</p>
                            <div class="mb-3">
                                <small class="d-block mb-2 text-muted">Progress: 35%</small>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: 35%"></div>
                                </div>
                            </div>
                            <small class="text-muted d-block mb-2">Instruktur: Rina Wijaya</small>
                            <button class="btn btn-sm btn-outline-primary">Lanjut Belajar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Python Data Science</h5>
                            <p class="card-text text-muted">Data science dengan Python</p>
                            <div class="mb-3">
                                <small class="d-block mb-2 text-muted">Progress: 85%</small>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-info" style="width: 85%"></div>
                                </div>
                            </div>
                            <small class="text-muted d-block mb-2">Instruktur: Ahmad Pratama</small>
                            <button class="btn btn-sm btn-outline-primary">Lanjut Belajar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Laravel</h5>
                            <p class="card-text text-muted">Web framework Laravel</p>
                            <div class="mb-3">
                                <small class="d-block mb-2 text-muted">Progress: 25%</small>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" style="width: 25%; background-color: #6f42c1;"></div>
                                </div>
                            </div>
                            <small class="text-muted d-block mb-2">Instruktur: Sinta Kusuma</small>
                            <button class="btn btn-sm btn-outline-primary">Lanjut Belajar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection