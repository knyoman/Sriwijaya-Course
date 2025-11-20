@extends('layouts.app')

@section('title', 'Belajar Kursus - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <div class="mb-4">
                <a href="{{ route('student.courses') }}" class="btn btn-outline-secondary btn-sm mb-3">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
                <h1 class="fw-bold">{{ $course->nama ?? 'Web Development Basics' }}</h1>
                <p class="text-muted">Instruktur: {{ $course->pengajar->nama ?? 'Doni Santoso' }}</p>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <!-- Video Player -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-0">
                            @php
                            use App\Helpers\VideoHelper;
                            $embedUrl = $materiFirst ? VideoHelper::getYoutubeEmbedUrl($materiFirst->url_konten) : null;
                            @endphp
                            @if($embedUrl)
                            <iframe width="100%" height="400" src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <div class="p-3">
                                <h6 class="fw-bold mb-1">{{ $materiFirst->judul_materi }}</h6>
                                <small class="text-muted">{{ $materiFirst->durasi_menit ?? 'Durasi tidak tersedia' }} menit</small>
                                <p class="text-muted small mt-2 mb-0">{{ $materiFirst->deskripsi }}</p>
                            </div>
                            @else
                            <div style="width: 100%; height: 400px; background: #000; display: flex; align-items: center; justify-content: center;">
                                <div class="text-center text-white">
                                    <i class="fa-solid fa-play" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                    <p>Belum ada video pembelajaran</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0">Materi Pembelajaran</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#overview">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#materials">Materi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#discussion">Diskusi</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="overview" class="tab-pane fade show active">
                                    <h6 class="fw-bold mb-3">Deskripsi Kursus</h6>
                                    <p class="text-muted">{{ $course->deskripsi ?? 'Kursus ini dirancang untuk pemula yang ingin memulai perjalanan mereka di dunia web development. Anda akan mempelajari:' }}</p>
                                </div>

                                <div id="materials" class="tab-pane fade">
                                    <h6 class="fw-bold mb-3">Daftar Materi</h6>
                                    @if($materiList->count() > 0)
                                    <div class="list-group">
                                        @foreach($materiList as $m)
                                        <button onclick="loadMaterial({{ $m->id }}, '{{ addslashes($m->judul_materi) }}', '{{ addslashes($m->url_konten) }}', {{ $m->durasi_menit }}, '{{ addslashes($m->deskripsi ?? '') }}')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" style="border: none; background: none; width: 100%; text-align: left;">
                                            <div>
                                                @if($m->tipe_konten === 'video')
                                                <i class="fa-solid fa-video me-2 text-danger"></i>
                                                @elseif($m->tipe_konten === 'dokumen')
                                                <i class="fa-solid fa-file-pdf me-2 text-danger"></i>
                                                @endif
                                                <span>{{ $m->judul_materi }}</span>
                                            </div>
                                            <small class="text-muted">{{ $m->durasi_menit ?? '—' }} menit</small>
                                        </button>
                                        @endforeach
                                    </div>
                                    @else
                                    <div class="alert alert-info">
                                        <p class="mb-0">Belum ada materi tersedia.</p>
                                    </div>
                                    @endif
                                </div>
                                <div id="discussion" class="tab-pane fade">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="fw-bold mb-0">Diskusi Kelas</h6>
                                        <a href="{{ route('student.courses.diskusi.index', $course->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-comments me-2"></i>Lihat Semua Diskusi
                                        </a>
                                    </div>

                                    @if($diskusi->count() > 0)
                                    @foreach($diskusi->take(3) as $item)
                                    <div class="mb-3 pb-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <a href="{{ route('student.courses.diskusi.show', [$course->id, $item->id]) }}" class="text-decoration-none">
                                                    <strong class="text-dark d-block mb-1">{{ $item->judul }}</strong>
                                                </a>
                                                <p class="text-muted small mb-2">{{ Str::limit($item->konten, 100) }}</p>
                                                <div class="d-flex gap-3">
                                                    <small class="text-muted">
                                                        <i class="fa-solid fa-user me-1"></i> {{ $item->pembuat->nama }}
                                                    </small>
                                                    <small class="text-muted">
                                                        <i class="fa-solid fa-comments me-1"></i> {{ $item->jumlah_balasan }} balasan
                                                    </small>
                                                    <small class="text-muted">
                                                        <i class="fa-solid fa-clock me-1"></i> {{ $item->created_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="alert alert-info">
                                        <p class="mb-0">Belum ada diskusi. Mulai diskusi pertama Anda dengan mengklik tombol di atas!</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Chapters -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0">Daftar Materi</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @if($materiList->count() > 0)
                                @foreach($materiList as $m)
                                <button onclick="loadMaterial({{ $m->id }}, '{{ $m->judul_materi }}', '{{ $m->url_konten }}', {{ $m->durasi_menit }}, '{{ addslashes($m->deskripsi) }}')" class="list-group-item list-group-item-action d-flex align-items-center text-start" style="padding: 0.75rem 1rem; border: none; background: none; width: 100%; cursor: pointer;">
                                    @if($m->tipe_konten === 'video')
                                    <i class="fa-solid fa-play text-primary me-2"></i>
                                    @elseif($m->tipe_konten === 'dokumen')
                                    <i class="fa-solid fa-file text-danger me-2"></i>
                                    @else
                                    <i class="fa-solid fa-circle text-muted me-2"></i>
                                    @endif
                                    <span>{{ $m->judul_materi }}</span>
                                </button>
                                @endforeach
                                @else
                                <div class="p-3 text-muted text-center">
                                    <small>Tidak ada materi</small>
                                </div>
                                @endif
                                @if($course->quiz()->count() > 0)
                                @foreach($course->quiz as $q)
                                <a href="{{ route('student.quiz.show', [$course->id, $q->id]) }}" class="list-group-item list-group-item-action d-flex align-items-center" style="padding: 0.75rem 1rem;">
                                    <i class="fa-solid fa-circle text-warning me-2"></i>
                                    <span>{{ $q->nama_quiz }}</span>
                                </a>
                                @endforeach
                                @else
                                <a href="{{ route('student.quiz') }}" class="list-group-item list-group-item-action d-flex align-items-center" style="padding: 0.75rem 1rem;">
                                    <i class="fa-solid fa-circle text-muted me-2"></i>
                                    <span>Quiz</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function loadMaterial(id, title, url, duration, description) {
        const videoPlayer = document.querySelector('.card-body p-0');
        const embedUrl = '{{ route("student.course-learn", $course->id) }}' + '?material=' + id;

        // Build embed URL from YouTube URL
        let embedSrc = '';
        if (url) {
            // Extract YouTube video ID
            let videoId = null;
            if (url.match(/youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/)) {
                videoId = url.match(/youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/)[1];
            } else if (url.match(/youtu\.be\/([a-zA-Z0-9_-]{11})/)) {
                videoId = url.match(/youtu\.be\/([a-zA-Z0-9_-]{11})/)[1];
            } else if (url.match(/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/)) {
                videoId = url.match(/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/)[1];
            } else if (url.match(/^[a-zA-Z0-9_-]{11}$/)) {
                videoId = url;
            }

            if (videoId) {
                embedSrc = `https://www.youtube.com/embed/${videoId}?rel=0`;
            }
        }

        // Update video player
        const videoPlayerDiv = document.querySelector('.card-body.p-0');
        if (embedSrc) {
            videoPlayerDiv.innerHTML = `
            <iframe width="100%" height="400" src="${embedSrc}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="p-3">
                <h6 class="fw-bold mb-1">${title}</h6>
                <small class="text-muted">${duration ? duration + ' menit' : 'Durasi tidak tersedia'}</small>
                <p class="text-muted small mt-2 mb-0">${description}</p>
            </div>
        `;
        } else {
            videoPlayerDiv.innerHTML = `
            <div style="width: 100%; height: 400px; background: #000; display: flex; align-items: center; justify-content: center;">
                <div class="text-center text-white">
                    <i class="fa-solid fa-exclamation-circle" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>Video tidak tersedia</p>
                </div>
            </div>
        `;
        }
    }
</script>
@endsection