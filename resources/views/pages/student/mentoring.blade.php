@extends('layouts.app')

@section('title', 'Jadwal Mentoring - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <!-- Alert Success -->
            @if($message = session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check-circle me-2"></i>{{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="mb-4">
                <h1 class="fw-bold">Jadwal Mentoring</h1>
                <p class="text-muted">Daftar sesi mentoring yang tersedia dan telah Anda ikuti</p>
            </div>

            <!-- Filter/Tab Status -->
            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#semua">Semua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#belum">Belum Dimulai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#berlangsung">Sedang Berlangsung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#selesai">Selesai</a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Tab: Semua -->
                <div id="semua" class="tab-pane fade show active">
                    <div class="row">
                        @forelse($mentorings as $mentoring)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 shadow-sm border-0" style="transition: all 0.3s;">
                                <!-- Header Card dengan Status -->
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">{{ $mentoring->pengajar->nama }}</h6>
                                    <span class="badge 
                                        @if($mentoring->status === 'Belum') bg-warning
                                        @elseif($mentoring->status === 'Sedang Berlangsung') bg-info
                                        @else bg-success
                                        @endif">
                                        {{ $mentoring->status }}
                                    </span>
                                </div>

                                <div class="card-body">
                                    <!-- Topik Mentoring -->
                                    <p class="fw-bold text-primary mb-3">{{ $mentoring->topik }}</p>

                                    <!-- Kursus -->
                                    @if($mentoring->kursus)
                                    <p class="small text-info mb-3">
                                        <i class="fa-solid fa-book"></i>
                                        <span class="ms-2">{{ $mentoring->kursus->nama }}</span>
                                    </p>
                                    @endif

                                    <!-- Informasi Detail -->
                                    <div class="small mb-3">
                                        <div class="mb-2">
                                            <i class="fa-solid fa-calendar text-primary"></i>
                                            <strong class="ms-2">{{ $mentoring->tanggal->locale('id')->translatedFormat('l, d F Y') }}</strong>
                                        </div>
                                        <div class="mb-2">
                                            <i class="fa-solid fa-clock text-primary"></i>
                                            <strong class="ms-2">
                                                {{ $mentoring->jam }} -
                                                @if($mentoring->jam && $mentoring->durasi)
                                                {{ \Carbon\Carbon::parse($mentoring->jam)->addMinutes($mentoring->durasi)->format('H:i') }}
                                                @else
                                                -
                                                @endif
                                            </strong>
                                        </div>
                                        <div class="mb-2">
                                            <i class="fa-solid fa-hourglass-end text-info"></i>
                                            <span class="ms-2">{{ $mentoring->durasi }} menit</span>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-users text-success"></i>
                                            <span class="ms-2">
                                                Peserta:
                                                @if($mentoring->kursus)
                                                {{ $mentoring->kursus->pelajar()->count() }}
                                                @else
                                                -
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <hr class="my-2">

                                    <!-- Tombol Aksi -->
                                    <div class="d-flex gap-2 flex-wrap">
                                        @if($mentoring->zoom_link && $mentoring->status !== 'Belum')
                                        <a href="{{ $mentoring->zoom_link }}" target="_blank" class="btn btn-info btn-sm grow">
                                            <i class="fa-solid fa-video"></i> Join Zoom
                                        </a>
                                        @endif

                                        <!-- Tombol Feedback (hanya jika sudah selesai) -->
                                        @if($mentoring->status === 'Sudah')
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $mentoring->id }}">
                                            <i class="fa-solid fa-comment"></i> Feedback
                                        </button>

                                        <!-- Modal Feedback -->
                                        <div class="modal fade" id="feedbackModal{{ $mentoring->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Berikan Feedback</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('student.mentoring.feedback', $mentoring->id) }}">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <!-- Error Display -->
                                                            @if($errors->any())
                                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <strong>Ada kesalahan:</strong>
                                                                <ul class="mb-0 mt-2">
                                                                    @foreach($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                            </div>
                                                            @endif

                                                            <!-- Rating -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Rating <span class="text-danger">*</span></label>
                                                                <div class="btn-group d-flex gap-2" role="group">
                                                                    @for($i = 1; $i <= 5; $i++)
                                                                        <input type="radio" class="btn-check" name="rating" id="rating{{ $mentoring->id }}_{{ $i }}" value="{{ $i }}" required>
                                                                        <label class="btn btn-outline-warning" for="rating{{ $mentoring->id }}_{{ $i }}">
                                                                            <i class="fa-solid fa-star"></i> {{ $i }}
                                                                        </label>
                                                                        @endfor
                                                                </div>
                                                            </div>

                                                            <!-- Umpan Balik -->
                                                            <div class="mb-3">
                                                                <label for="feedback_text" class="form-label">Umpan Balik <span class="text-danger">*</span></label>
                                                                <textarea class="form-control" id="feedback_text" name="feedback_text" rows="4" placeholder="Bagikan pengalaman dan saran Anda..." required></textarea>
                                                                <small class="text-muted">Minimal 10 karakter</small>
                                                            </div>

                                                            <!-- Checkbox Manfaat -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Manfaat yang Anda Dapatkan</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="benefits[]" value="materi_jelas" id="benefit1{{ $mentoring->id }}">
                                                                    <label class="form-check-label" for="benefit1{{ $mentoring->id }}">
                                                                        Materi dijelaskan dengan jelas
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="benefits[]" value="interaktif" id="benefit2{{ $mentoring->id }}">
                                                                    <label class="form-check-label" for="benefit2{{ $mentoring->id }}">
                                                                        Sesi interaktif
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="benefits[]" value="pertanyaan_terjawab" id="benefit3{{ $mentoring->id }}">
                                                                    <label class="form-check-label" for="benefit3{{ $mentoring->id }}">
                                                                        Pertanyaan saya terjawab
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Kirim Feedback</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($mentoring->status === 'Belum')
                                        <small class="text-muted">Belum dimulai</small>
                                        @else
                                        <small class="text-info">Sedang berlangsung...</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <i class="fa-solid fa-info-circle me-2"></i>
                                Belum ada jadwal mentoring
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab: Belum Dimulai -->
                <div id="belum" class="tab-pane fade">
                    <div class="row">
                        @forelse($mentorings->where('status', 'Belum') as $mentoring)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">{{ $mentoring->pengajar->nama }}</h6>
                                    <span class="badge bg-warning">Belum Dimulai</span>
                                </div>
                                <div class="card-body">
                                    <p class="fw-bold text-primary mb-3">{{ $mentoring->topik }}</p>
                                    <div class="small mb-3">
                                        <div class="mb-2"><i class="fa-solid fa-calendar text-primary"></i> <strong class="ms-2">{{ $mentoring->tanggal->locale('id')->translatedFormat('l, d F Y') }}</strong></div>
                                        <div class="mb-2"><i class="fa-solid fa-clock text-primary"></i> <strong class="ms-2">{{ $mentoring->jam }}</strong></div>
                                        <div class="mb-2"><i class="fa-solid fa-hourglass-end text-info"></i> <span class="ms-2">{{ $mentoring->durasi }} menit</span></div>
                                        <div><i class="fa-solid fa-users text-success"></i> <span class="ms-2">Peserta: @if($mentoring->kursus){{ $mentoring->kursus->pelajar()->count() }}@else-@endif</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info">Tidak ada sesi yang belum dimulai</div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab: Sedang Berlangsung -->
                <div id="berlangsung" class="tab-pane fade">
                    <div class="row">
                        @forelse($mentorings->where('status', 'Sedang Berlangsung') as $mentoring)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 shadow-sm" style="border: 3px solid #0dcaf0;">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">{{ $mentoring->pengajar->nama }}</h6>
                                    <span class="badge bg-info">Sedang Berlangsung</span>
                                </div>
                                <div class="card-body">
                                    <p class="fw-bold text-primary mb-3">{{ $mentoring->topik }}</p>
                                    <div class="small mb-3">
                                        <div class="mb-2"><i class="fa-solid fa-calendar text-primary"></i> <strong class="ms-2">{{ $mentoring->tanggal->locale('id')->translatedFormat('l, d F Y') }}</strong></div>
                                        <div class="mb-2"><i class="fa-solid fa-clock text-primary"></i> <strong class="ms-2">{{ $mentoring->jam }}</strong></div>
                                        <div class="mb-2"><i class="fa-solid fa-hourglass-end text-info"></i> <span class="ms-2">{{ $mentoring->durasi }} menit</span></div>
                                        <div><i class="fa-solid fa-users text-success"></i> <span class="ms-2">Peserta: @if($mentoring->kursus){{ $mentoring->kursus->pelajar()->count() }}@else-@endif</span></div>
                                    </div>
                                    @if($mentoring->zoom_link)
                                    <a href="{{ $mentoring->zoom_link }}" target="_blank" class="btn btn-info btn-sm w-100">
                                        <i class="fa-solid fa-video"></i> Join Zoom Sekarang
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info">Tidak ada sesi yang sedang berlangsung</div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab: Selesai -->
                <div id="selesai" class="tab-pane fade">
                    <div class="row">
                        @forelse($mentorings->where('status', 'Sudah') as $mentoring)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">{{ $mentoring->pengajar->nama }}</h6>
                                    <span class="badge bg-success">Selesai</span>
                                </div>
                                <div class="card-body">
                                    <p class="fw-bold text-primary mb-3">{{ $mentoring->topik }}</p>
                                    <div class="small mb-3">
                                        <div class="mb-2"><i class="fa-solid fa-calendar text-primary"></i> <strong class="ms-2">{{ $mentoring->tanggal->locale('id')->translatedFormat('l, d F Y') }}</strong></div>
                                        <div class="mb-2"><i class="fa-solid fa-clock text-primary"></i> <strong class="ms-2">{{ $mentoring->jam }}</strong></div>
                                        <div class="mb-2"><i class="fa-solid fa-hourglass-end text-info"></i> <span class="ms-2">{{ $mentoring->durasi }} menit</span></div>
                                        <div><i class="fa-solid fa-users text-success"></i> <span class="ms-2">Peserta: @if($mentoring->kursus){{ $mentoring->kursus->pelajar()->count() }}@else-@endif</span></div>
                                    </div>
                                    <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $mentoring->id }}">
                                        <i class="fa-solid fa-comment"></i> Berikan Feedback
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info">Tidak ada sesi yang sudah selesai</div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection