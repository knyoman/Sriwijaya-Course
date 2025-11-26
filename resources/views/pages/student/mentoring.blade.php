@extends('layouts.app')

@section('title', 'Jadwal Mentoring - Kursus Sriwijaya')

@section('content')
{{-- Load FontAwesome CDN --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .card-mentoring {
        border: 1px solid #f0f0f0;
        border-radius: 16px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        background: #fff;
        overflow: hidden;
        position: relative;
    }

    .card-mentoring:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05) !important;
        border-color: #e2e8f0;
    }

    /* Badge Status */
    .badge-absolute {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
        padding: 6px 12px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.7rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .badge-soft-warning {
        background-color: #fff8e1;
        color: #b76e00;
    }

    .badge-soft-info {
        background-color: #e1f5fe;
        color: #0277bd;
    }

    .badge-soft-success {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    /* Animasi Border Card (Pulse Biru) */
    @keyframes pulse-blue {
        0% {
            box-shadow: 0 0 0 0 rgba(13, 202, 240, 0.4);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(13, 202, 240, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(13, 202, 240, 0);
        }
    }

    .mentoring-ongoing {
        border: 1px solid #0dcaf0;
        animation: pulse-blue 2s infinite;
    }

    /* === ANIMASI DOT BLINK (BIRU-MERAH) === */
    @keyframes blink-red-blue {
        0% {
            color: #0dcaf0;
            opacity: 1;
        }

        /* Biru */
        50% {
            color: #dc3545;
            opacity: 1;
        }

        /* Merah */
        100% {
            color: #0dcaf0;
            opacity: 1;
        }

        /* Kembali Biru */
    }

    .dot-blink {
        animation: blink-red-blue 1s infinite linear;
    }

    /* Ikon Box */
    .icon-box {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-right: 12px;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .bg-light-primary {
        background: #e3f2fd;
        color: #0d6efd;
    }

    .bg-light-info {
        background: #e0f7fa;
        color: #0dcaf0;
    }

    /* Tabs */
    .nav-pills-custom .nav-link {
        color: #6c757d;
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 50px;
        transition: all 0.2s;
    }

    .nav-pills-custom .nav-link.active {
        background-color: #0d6efd;
        color: white;
        box-shadow: 0 4px 6px rgba(13, 110, 253, 0.2);
    }

    /* Rating & Form Elements */
    .star-rating label {
        cursor: pointer;
        transition: transform 0.2s;
    }

    .star-rating label:hover {
        transform: scale(1.1);
    }

    .benefit-item {
        border: 1px solid #e9ecef;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 8px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .benefit-item:hover {
        background-color: #f8f9fa;
    }
</style>

<div class="d-flex bg-light" style="min-height: 100vh;">
    @include('components.sidebar-student')

    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding-bottom: 3rem;">
        <div class="container-fluid px-4">

            @if($message = session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-check-circle me-2 fs-5"></i>
                    <div>{{ $message }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="mb-4">
                <h2 class="fw-bold text-dark mb-1">Jadwal Mentoring</h2>
                <p class="text-muted mb-0">Kelola dan ikuti sesi mentoring untuk meningkatkan keahlian Anda.</p>
            </div>

            <div class="bg-white p-2 rounded-pill shadow-sm d-inline-block mb-4">
                <ul class="nav nav-pills nav-pills-custom" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="pill" href="#semua">Semua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#belum">Belum Dimulai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#berlangsung">Sedang Berlangsung</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#selesai">Selesai</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">

                <div id="semua" class="tab-pane fade show active">
                    <div class="row g-4">
                        @forelse($mentorings->filter(function($mentoring) use ($user) {
                        if ($mentoring->status === 'Sudah') {
                        return $mentoring->feedbacks->where('pelajar_id', $user->id)->count() > 0;
                        }
                        return true;
                        }) as $mentoring)
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="card card-mentoring h-100 shadow-sm {{ $mentoring->status === 'Sedang Berlangsung' ? 'mentoring-ongoing' : '' }}">

                                <span class="badge badge-absolute @if($mentoring->status === 'Belum') badge-soft-warning @elseif($mentoring->status === 'Sedang Berlangsung') badge-soft-info @else badge-soft-success @endif">
                                    @if($mentoring->status === 'Sedang Berlangsung')
                                    <i class="fa-solid fa-circle me-1 dot-blink" style="font-size: 6px;"></i>
                                    @endif
                                    {{ $mentoring->status }}
                                </span>

                                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3 text-center rounded-3 bg-light border p-2 flex-shrink-0" style="min-width: 60px;">
                                            <span class="d-block text-uppercase fw-bold text-danger" style="font-size: 0.7rem; letter-spacing: 1px;">{{ $mentoring->tanggal->locale('id')->format('M') }}</span>
                                            <span class="d-block fw-bold text-dark fs-4 lh-1">{{ $mentoring->tanggal->format('d') }}</span>
                                        </div>

                                        <div class="mt-3 w-100">
                                            <h6 class="fw-bold text-dark mb-1 lh-sm" title="{{ $mentoring->kursus->nama ?? 'Mentoring Umum' }}">
                                                {{ $mentoring->kursus->nama ?? 'Mentoring Umum' }}
                                            </h6>
                                            <div class="d-flex align-items-center text-muted small mt-1">
                                                <i class="fa-solid fa-user me-2 text-primary opacity-75"></i>
                                                {{ $mentoring->pengajar->nama }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body px-4 py-3 d-flex flex-column">
                                    <hr class="border-light mb-3 mt-1">

                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box bg-light-primary text-primary">
                                                    <i class="fa-regular fa-clock"></i>
                                                </div>
                                                <div style="min-width: 0;">
                                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Waktu</small>
                                                    {{-- FORMAT WAKTU H:i (21:00) --}}
                                                    <span class="fw-bold fs-6 text-truncate d-block">
                                                        {{ \Carbon\Carbon::parse($mentoring->jam)->format('H:i') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box bg-light-info text-info">
                                                    <i class="fa-solid fa-hourglass-half"></i>
                                                </div>
                                                <div style="min-width: 0;">
                                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Durasi</small>
                                                    <span class="fw-bold fs-6 text-truncate d-block">{{ $mentoring->durasi }} Min</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-auto">
                                        @if($mentoring->status === 'Sedang Berlangsung' && $mentoring->zoom_link)
                                        <a href="{{ $mentoring->zoom_link }}" target="_blank" class="btn btn-info text-white w-100 mb-2 fw-bold shadow-sm py-2" style="border-radius: 10px;">
                                            <i class="fa-solid fa-video me-2"></i> Join Zoom
                                        </a>
                                        @endif

                                        @if($mentoring->status === 'Sedang Berlangsung')
                                        <button class="btn btn-outline-primary w-100 fw-bold py-2" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $mentoring->id }}">
                                            <i class="fa-regular fa-comment-dots me-2"></i> Beri Feedback
                                        </button>
                                        @elseif($mentoring->status === 'Sudah')
                                        <button class="btn btn-light w-100 text-muted py-2" style="border-radius: 10px;" disabled>
                                            <i class="fa-solid fa-check me-2"></i> Selesai
                                        </button>
                                        @else
                                        <button class="btn btn-light w-100 text-muted py-2" style="border-radius: 10px;" disabled>
                                            <i class="fa-regular fa-calendar me-2"></i> Menunggu
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL FEEDBACK --}}
                        <div class="modal fade" id="feedbackModal{{ $mentoring->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header border-bottom-0 pb-0">
                                        <h5 class="modal-title fw-bold">Feedback Sesi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" action="{{ route('student.mentoring.feedback', $mentoring->id) }}">
                                        @csrf
                                        <div class="modal-body">
                                            <p class="text-muted small mb-4">Bagaimana pengalaman mentoring Anda dengan <strong>{{ $mentoring->pengajar->nama }}</strong>?</p>

                                            @if($errors->any())
                                            <div class="alert alert-danger p-2 fs-6 mb-3 rounded-3">
                                                <ul class="mb-0 ps-3">
                                                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                                                </ul>
                                            </div>
                                            @endif

                                            <div class="mb-4 text-center star-rating">
                                                <label class="form-label d-block fw-bold mb-2">Berikan Rating <span class="text-danger">*</span></label>
                                                <div class="btn-group" role="group">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <input type="radio" class="btn-check" name="rating" id="rating{{ $mentoring->id }}_{{ $i }}" value="{{ $i }}" required>
                                                        <label class="btn btn-outline-warning rounded-circle mx-1 d-flex align-items-center justify-content-center shadow-none" style="width: 45px; height: 45px; border: 2px solid #ffc107;" for="rating{{ $mentoring->id }}_{{ $i }}">
                                                            <span class="fs-5 fw-bold">{{ $i }}</span>
                                                        </label>
                                                        @endfor
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold small text-uppercase text-muted">Umpan Balik <span class="text-danger">*</span></label>
                                                <textarea class="form-control bg-light border-0 rounded-3 p-3" name="feedback_text" rows="3" placeholder="Ceritakan pengalaman Anda..." required style="resize: none;"></textarea>
                                                <small class="text-muted">Minimal 10 karakter</small>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold small text-uppercase text-muted">Manfaat yang Anda Dapatkan</label>
                                                <div class="d-flex flex-column">
                                                    <label class="benefit-item d-flex align-items-center">
                                                        <input class="form-check-input me-2 mt-0" type="checkbox" name="benefits[]" value="materi_jelas" id="benefit1{{ $mentoring->id }}">
                                                        <span class="small">Materi dijelaskan dengan jelas</span>
                                                    </label>
                                                    <label class="benefit-item d-flex align-items-center">
                                                        <input class="form-check-input me-2 mt-0" type="checkbox" name="benefits[]" value="interaktif" id="benefit2{{ $mentoring->id }}">
                                                        <span class="small">Sesi sangat interaktif</span>
                                                    </label>
                                                    <label class="benefit-item d-flex align-items-center">
                                                        <input class="form-check-input me-2 mt-0" type="checkbox" name="benefits[]" value="pertanyaan_terjawab" id="benefit3{{ $mentoring->id }}">
                                                        <span class="small">Pertanyaan saya terjawab</span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer border-top-0 pt-0">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">Kirim Feedback</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <div class="mb-3"><i class="fa-regular fa-calendar-times fa-3x text-muted opacity-50"></i></div>
                            <h5 class="text-muted">Belum ada jadwal mentoring.</h5>
                        </div>
                        @endforelse
                    </div>
                </div>

                <div id="belum" class="tab-pane fade">
                    <div class="row g-4">
                        @forelse($mentorings->where('status', 'Belum') as $mentoring)
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="card card-mentoring h-100 shadow-sm">
                                <span class="badge badge-absolute badge-soft-warning">Belum</span>
                                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3 text-center rounded-3 bg-light border p-2 flex-shrink-0" style="min-width: 60px;">
                                            <span class="d-block text-uppercase fw-bold text-danger" style="font-size: 0.7rem; letter-spacing: 1px;">{{ $mentoring->tanggal->locale('id')->format('M') }}</span>
                                            <span class="d-block fw-bold text-dark fs-4 lh-1">{{ $mentoring->tanggal->format('d') }}</span>
                                        </div>
                                        <div class="mt-3 w-100">
                                            <h6 class="fw-bold text-dark mb-1 lh-sm" title="{{ $mentoring->kursus->nama ?? 'Mentoring Umum' }}">
                                                {{ $mentoring->kursus->nama ?? 'Mentoring Umum' }}
                                            </h6>
                                            <div class="d-flex align-items-center text-muted small mt-1">
                                                <i class="fa-solid fa-user me-2 text-primary opacity-75"></i> {{ $mentoring->pengajar->nama }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-4 py-3 d-flex flex-column">
                                    <hr class="border-light mb-3 mt-1">
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box bg-light-primary text-primary"><i class="fa-regular fa-clock"></i></div>
                                                <div>
                                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Waktu</small>
                                                    <span class="fw-bold fs-6 text-truncate d-block">
                                                        {{ \Carbon\Carbon::parse($mentoring->jam)->format('H:i') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box bg-light-info text-info"><i class="fa-solid fa-hourglass-half"></i></div>
                                                <div><small class="text-muted d-block" style="font-size: 0.7rem;">Durasi</small><span class="fw-bold fs-6">{{ $mentoring->durasi }} Min</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-light w-100 text-muted py-2 mt-auto" style="border-radius: 10px;" disabled><i class="fa-regular fa-calendar me-2"></i> Menunggu</button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <div class="mb-3"><i class="fa-regular fa-clock fa-3x text-muted opacity-50"></i></div>
                            <h5 class="text-muted">Tidak ada sesi yang belum dimulai.</h5>
                        </div>
                        @endforelse
                    </div>
                </div>

                <div id="berlangsung" class="tab-pane fade">
                    <div class="row g-4">
                        @forelse($mentorings->where('status', 'Sedang Berlangsung') as $mentoring)
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="card card-mentoring h-100 shadow-sm mentoring-ongoing">
                                <span class="badge badge-absolute badge-soft-info">
                                    <i class="fa-solid fa-circle me-1 dot-blink" style="font-size: 6px;"></i>
                                    Berlangsung
                                </span>
                                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3 text-center rounded-3 bg-light border p-2 flex-shrink-0" style="min-width: 60px;">
                                            <span class="d-block text-uppercase fw-bold text-danger" style="font-size: 0.7rem; letter-spacing: 1px;">{{ $mentoring->tanggal->locale('id')->format('M') }}</span>
                                            <span class="d-block fw-bold text-dark fs-4 lh-1">{{ $mentoring->tanggal->format('d') }}</span>
                                        </div>
                                        <div class="mt-3 w-100">
                                            <h6 class="fw-bold text-dark mb-1 lh-sm" title="{{ $mentoring->kursus->nama ?? 'Mentoring Umum' }}">{{ $mentoring->kursus->nama ?? 'Mentoring Umum' }}</h6>
                                            <div class="d-flex align-items-center text-muted small mt-1"><i class="fa-solid fa-user me-2 text-primary opacity-75"></i> {{ $mentoring->pengajar->nama }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-4 py-3 d-flex flex-column">
                                    <hr class="border-light mb-3 mt-1">
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box bg-light-primary text-primary"><i class="fa-regular fa-clock"></i></div>
                                                <div>
                                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Waktu</small>
                                                    <span class="fw-bold fs-6 text-truncate d-block">
                                                        {{ \Carbon\Carbon::parse($mentoring->jam)->format('H:i') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box bg-light-info text-info"><i class="fa-solid fa-hourglass-half"></i></div>
                                                <div><small class="text-muted d-block" style="font-size: 0.7rem;">Durasi</small><span class="fw-bold fs-6">{{ $mentoring->durasi }} Min</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-auto">
                                        @if($mentoring->zoom_link)<a href="{{ $mentoring->zoom_link }}" target="_blank" class="btn btn-info text-white w-100 mb-2 fw-bold shadow-sm py-2" style="border-radius: 10px;"><i class="fa-solid fa-video me-2"></i> Join Zoom</a>@endif
                                        <button class="btn btn-outline-primary w-100 fw-bold py-2" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#feedbackModalTab{{ $mentoring->id }}"><i class="fa-regular fa-comment-dots me-2"></i> Beri Feedback</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Duplicate for this tab --}}
                        <div class="modal fade" id="feedbackModalTab{{ $mentoring->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header border-bottom-0 pb-0">
                                        <h5 class="modal-title fw-bold">Feedback Sesi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" action="{{ route('student.mentoring.feedback', $mentoring->id) }}">
                                        @csrf
                                        <div class="modal-body">
                                            <p class="text-muted small mb-4">Bagaimana pengalaman mentoring Anda dengan <strong>{{ $mentoring->pengajar->nama }}</strong>?</p>
                                            <div class="mb-4 text-center star-rating">
                                                <label class="form-label d-block fw-bold mb-2">Berikan Rating <span class="text-danger">*</span></label>
                                                <div class="btn-group" role="group">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <input type="radio" class="btn-check" name="rating" id="ratingTab{{ $mentoring->id }}_{{ $i }}" value="{{ $i }}" required>
                                                        <label class="btn btn-outline-warning rounded-circle mx-1 d-flex align-items-center justify-content-center shadow-none" style="width: 45px; height: 45px; border: 2px solid #ffc107;" for="ratingTab{{ $mentoring->id }}_{{ $i }}"><span class="fs-5 fw-bold">{{ $i }}</span></label>
                                                        @endfor
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold small text-uppercase text-muted">Umpan Balik <span class="text-danger">*</span></label>
                                                <textarea class="form-control bg-light border-0 rounded-3 p-3" name="feedback_text" rows="3" placeholder="Ceritakan pengalaman Anda..." required style="resize: none;"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold small text-uppercase text-muted">Manfaat yang Anda Dapatkan</label>
                                                <div class="d-flex flex-column">
                                                    <label class="benefit-item d-flex align-items-center"><input class="form-check-input me-2 mt-0" type="checkbox" name="benefits[]" value="materi_jelas"><span class="small">Materi dijelaskan dengan jelas</span></label>
                                                    <label class="benefit-item d-flex align-items-center"><input class="form-check-input me-2 mt-0" type="checkbox" name="benefits[]" value="interaktif"><span class="small">Sesi sangat interaktif</span></label>
                                                    <label class="benefit-item d-flex align-items-center"><input class="form-check-input me-2 mt-0" type="checkbox" name="benefits[]" value="pertanyaan_terjawab"><span class="small">Pertanyaan saya terjawab</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 pt-0">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">Kirim Feedback</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <div class="mb-3"><i class="fa-solid fa-video-slash fa-3x text-muted opacity-50"></i></div>
                            <h5 class="text-muted">Tidak ada sesi yang sedang berlangsung.</h5>
                        </div>
                        @endforelse
                    </div>
                </div>

                <div id="selesai" class="tab-pane fade">
                    <div class="row g-4">
                        @forelse($mentorings->where('status', 'Sudah')->filter(function($mentoring) use ($user) {
                        return $mentoring->feedbacks->where('pelajar_id', $user->id)->count() > 0;
                        }) as $mentoring)
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="card card-mentoring h-100 shadow-sm">
                                <span class="badge badge-absolute badge-soft-success">Selesai</span>
                                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3 text-center rounded-3 bg-light border p-2 flex-shrink-0" style="min-width: 60px;">
                                            <span class="d-block text-uppercase fw-bold text-danger" style="font-size: 0.7rem; letter-spacing: 1px;">{{ $mentoring->tanggal->locale('id')->format('M') }}</span>
                                            <span class="d-block fw-bold text-dark fs-4 lh-1">{{ $mentoring->tanggal->format('d') }}</span>
                                        </div>
                                        <div class="mt-3 w-100">
                                            <h6 class="fw-bold text-dark mb-1 lh-sm" title="{{ $mentoring->kursus->nama ?? 'Mentoring Umum' }}">{{ $mentoring->kursus->nama ?? 'Mentoring Umum' }}</h6>
                                            <div class="d-flex align-items-center text-muted small mt-1"><i class="fa-solid fa-user me-2 text-primary opacity-75"></i> {{ $mentoring->pengajar->nama }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-4 py-3 d-flex flex-column">
                                    <hr class="border-light mb-3 mt-1">
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box bg-light-primary text-primary"><i class="fa-regular fa-clock"></i></div>
                                                <div>
                                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Waktu</small>
                                                    <span class="fw-bold fs-6 text-truncate d-block">
                                                        {{ \Carbon\Carbon::parse($mentoring->jam)->format('H:i') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box bg-light-info text-info"><i class="fa-solid fa-hourglass-half"></i></div>
                                                <div><small class="text-muted d-block" style="font-size: 0.7rem;">Durasi</small><span class="fw-bold fs-6">{{ $mentoring->durasi }} Min</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-light w-100 text-muted py-2 mt-auto" style="border-radius: 10px;" disabled><i class="fa-solid fa-check me-2"></i> Selesai</button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <div class="mb-3"><i class="fa-solid fa-check-double fa-3x text-muted opacity-50"></i></div>
                            <h5 class="text-muted">Belum ada sesi yang selesai atau Anda belum memberikan feedback.</h5>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>
@endsection