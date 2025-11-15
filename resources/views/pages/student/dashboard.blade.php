<?php
// Tambahkan route publik sementara (untuk pengujian)
Route::get('/student', function () {
    return view('pages.student.dashboard');
})->name('student.dashboard.public');
?>

@extends('layouts.app')
@section('title', 'Dashboard Pelajar')
@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main class="flex-fill p-4">
        <h5>Dashboard Pelajar</h5>
        <div class="alert alert-info">Selamat datang, {{ optional(auth()->user())->nama ?? 'Pelajar' }}.</div>
    </main>
</div>
@endsection