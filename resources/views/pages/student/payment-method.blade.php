@extends('layouts.app')

@section('title', 'Pilih Metode Pembayaran - Kursus Sriwijaya')

@section('content')
{{-- Style Khusus untuk Halaman Ini --}}
<style>
    :root {
        --primary-color: #0d6efd;
        --bg-light: #f8f9fa;
        --border-radius: 16px;
    }

    body {
        background-color: #f3f4f6;
    }

    .main-content {
        flex: 1;
        margin-left: 250px;
        /* Default desktop */
        padding: 2rem;
        padding-top: 5rem;
        /* Memberi ruang agar tidak tertutup navbar */
        min-height: 100vh;
        transition: margin-left 0.3s;
    }

    /* Typography & Spacing Fixes */
    .course-title {
        font-size: 1.1rem;
        line-height: 1.5;
        color: #212529;
        word-wrap: break-word;
        /* Mencegah teks panjang terpotong */
        white-space: normal;
        /* Memastikan teks turun ke bawah */
    }

    /* Card Styling */
    .card-custom {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s;
        background: #fff;
    }

    /* Payment Option Styling */
    .payment-option-label {
        cursor: pointer;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
        position: relative;
        overflow: hidden;
    }

    .payment-option-label:hover {
        border-color: #cbd5e1;
        background-color: #fcfcfc;
        transform: translateY(-2px);
    }

    /* Active State (Checked) */
    .payment-option-input:checked+.payment-option-label {
        border-color: var(--primary-color);
        background-color: #f0f7ff;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
    }

    .payment-option-input:checked+.payment-option-label .icon-wrapper {
        background-color: var(--primary-color);
        color: white;
        transform: scale(1.1);
    }

    .payment-option-input:checked+.payment-option-label .check-icon {
        opacity: 1 !important;
        transform: scale(1);
    }

    /* Icon Styling */
    .icon-wrapper {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background-color: #f1f5f9;
        color: #64748b;
        font-size: 1.4rem;
        transition: all 0.3s ease;
        flex-shrink: 0;
        /* Mencegah icon mengecil jika layar sempit */
    }

    .check-icon {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        transform: scale(0.5);
    }

    /* Button Styling */
    .btn-checkout {
        background: linear-gradient(45deg, #0d6efd, #0056b3);
        border: none;
        transition: all 0.3s;
    }

    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
    }

    /* Responsive Fixes */
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 1rem;
            padding-top: 5rem;
        }

        .icon-wrapper {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }
    }
</style>

@include('components.navbar-student')

<div class="d-flex">
    @include('components.sidebar-student')

    <main class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-9">

                    {{-- Header Section --}}
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-dark mb-2">Checkout Kursus</h2>
                        <p class="text-muted">Langkah terakhir sebelum mulai belajar keahlian baru.</p>
                    </div>

                    {{-- Order Summary Card --}}
                    <div class="card card-custom mb-4">
                        <div class="card-body p-4">
                            <h6 class="text-uppercase text-secondary fw-bold small mb-3 ls-1">Ringkasan Pesanan</h6>
                            <div class="d-flex align-items-start bg-light p-3 rounded-3 border border-light">
                                {{-- Icon Kursus --}}
                                <div class="bg-white p-3 rounded-3 me-3 shadow-sm d-flex align-items-center justify-content-center text-primary" style="height: 60px; width: 60px;">
                                    <i class="bi bi-book-half fs-3"></i>
                                </div>

                                {{-- Detail Kursus (Fix Truncation) --}}
                                <div class="flex-grow-1">
                                    {{-- Menggunakan text-break dan lh-base agar judul panjang terbaca --}}
                                    <h5 class="fw-bold mb-2 course-title text-break lh-base">
                                        {{ $course->nama }}
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-normal">
                                            <i class="bi bi-check-circle me-1"></i> Siap Mendaftar
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Method Form --}}
                    <div class="card card-custom">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3 text-primary">
                                    <i class="bi bi-credit-card-2-front fs-5"></i>
                                </div>
                                <h4 class="fw-bold mb-0">Pilih Pembayaran</h4>
                            </div>

                            <form action="{{ route('student.course.enroll.process', $course->id) }}" method="POST" id="payment-method-form">
                                @csrf

                                <div class="d-flex flex-column gap-3 mb-5">

                                    {{-- Option: Transfer Bank --}}
                                    <div class="payment-option">
                                        <input type="radio" class="payment-option-input d-none" name="metode_pembayaran" id="pay_bank" value="Transfer Bank" required>
                                        <label for="pay_bank" class="payment-option-label w-100 p-3 d-flex align-items-center">
                                            <div class="icon-wrapper me-3">
                                                <i class="bi bi-bank"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-1">Transfer Bank</h6>
                                                <div class="text-muted small">ATM, Mobile Banking, Internet Banking</div>
                                            </div>
                                            <i class="bi bi-check-circle-fill text-primary fs-4 opacity-0 check-icon"></i>
                                        </label>
                                    </div>

                                    {{-- Option: QRIS --}}
                                    <div class="payment-option">
                                        <input type="radio" class="payment-option-input d-none" name="metode_pembayaran" id="pay_qris" value="QRIS">
                                        <label for="pay_qris" class="payment-option-label w-100 p-3 d-flex align-items-center">
                                            <div class="icon-wrapper me-3">
                                                <i class="bi bi-qr-code-scan"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-1">QRIS</h6>
                                                <div class="text-muted small">Scan instan (GoPay, OVO, Dana, dll)</div>
                                            </div>
                                            <i class="bi bi-check-circle-fill text-primary fs-4 opacity-0 check-icon"></i>
                                        </label>
                                    </div>

                                    <hr class="border-secondary opacity-10 my-1">
                                    <h6 class="text-muted small fw-bold mb-1">E-Wallet</h6>

                                    {{-- E-Wallets Grid --}}
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <input type="radio" class="payment-option-input d-none" name="metode_pembayaran" id="pay_gopay" value="GoPay">
                                            <label for="pay_gopay" class="payment-option-label w-100 p-3 text-center h-100 d-flex flex-column justify-content-center align-items-center">
                                                <div class="fw-bold text-dark fs-5 mb-1" style="color: #00AED6 !important;">GoPay</div>
                                                <small class="text-muted" style="font-size: 0.75rem;">Gojek App</small>
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" class="payment-option-input d-none" name="metode_pembayaran" id="pay_ovo" value="OVO">
                                            <label for="pay_ovo" class="payment-option-label w-100 p-3 text-center h-100 d-flex flex-column justify-content-center align-items-center">
                                                <div class="fw-bold fs-5 mb-1" style="color: #4c3494 !important;">OVO</div>
                                                <small class="text-muted" style="font-size: 0.75rem;">Grab App</small>
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" class="payment-option-input d-none" name="metode_pembayaran" id="pay_dana" value="DANA">
                                            <label for="pay_dana" class="payment-option-label w-100 p-3 text-center h-100 d-flex flex-column justify-content-center align-items-center">
                                                <div class="fw-bold fs-5 mb-1" style="color: #118EEA !important;">DANA</div>
                                                <small class="text-muted" style="font-size: 0.75rem;">Dompet Digital</small>
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" class="payment-option-input d-none" name="metode_pembayaran" id="pay_spay" value="ShopeePay">
                                            <label for="pay_spay" class="payment-option-label w-100 p-3 text-center h-100 d-flex flex-column justify-content-center align-items-center">
                                                <div class="fw-bold fs-5 mb-1" style="color: #EE4D2D !important;">ShopeePay</div>
                                                <small class="text-muted" style="font-size: 0.75rem;">Shopee App</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-checkout btn-primary btn-lg w-100 py-3 fw-bold rounded-3 shadow-sm text-white">
                                    Bayar & Daftar Sekarang <i class="bi bi-arrow-right ms-2"></i>
                                </button>

                                <div class="text-center mt-4">
                                    <span class="d-inline-flex align-items-center text-muted small bg-light px-3 py-2 rounded-pill">
                                        <i class="bi bi-shield-lock-fill me-2 text-success"></i>
                                        Transaksi Anda 100% aman dan terenkripsi SSL.
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>
@endsection