@extends('layouts.app')

@section('title', 'About Me - Kursus Sriwijaya')

@section('content')
<div class="container py-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <img src="/Image/aboutme.png" alt="Profile" class="img-fluid rounded shadow">
        </div>
        <div class="col-lg-6">
            <h1 class="fw-bold mb-4">Sriwijaya Course</h1>
            <p class="lead mb-3">Sriwijaya Course adalah platform belajar yang berfokus pada pengembangan kemampuan akademik dan profesional melalui program pembelajaran yang terstruktur, interaktif, dan mudah dipahami. Kami menghadirkan berbagai kursus mulai dari bidang teknologi, bisnis, hingga pengembangan diri, dengan pendekatan yang relevan terhadap kebutuhan dunia kerja modern.</p>
            <div class="d-flex gap-3">
                <a href="#" class="btn btn-primary">Follow Instagram</a>
                <a href="#" class="btn btn-outline-primary">Hubungi Saya</a>
            </div>
        </div>
    </div>
</div>
@endsection