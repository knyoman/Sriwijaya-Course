@extends('layouts.app')

@section('title', 'Belajar Kursus - Kursus Sriwijaya')

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 250px; padding-top: 70px; padding: 2rem; padding-top: 70px;">
        <!-- Task Detail Modal -->
        <div class="modal fade" id="taskDetailModal" tabindex="-1" aria-labelledby="taskDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title fw-bold" id="modalTaskTitle">Detail Tugas</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <h6 class="fw-bold mb-2">
                                <i class="fa-solid fa-list-check me-2 text-info"></i>Instruksi Tugas
                            </h6>
                            <div class="p-3 bg-light rounded" id="modalTaskInstruksi" style="border-left: 4px solid #17a2b8;">
                                <em class="text-muted">Tidak ada instruksi</em>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">
                                <i class="fa-solid fa-question-circle me-2 text-warning"></i>Soal / Petunjuk
                            </h6>
                            <div class="p-3 bg-light rounded" id="modalTaskSoal" style="border-left: 4px solid #ffc107;">
                                <em class="text-muted">Tidak ada soal/petunjuk</em>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

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
                                    <a class="nav-link" data-bs-toggle="tab" href="#riwayat">Riwayat Tugas</a>
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
                                    @php
                                    $lulusMateriIds = auth()->check()
                                    ? auth()->user()->materiSubmissions()->where('status', 'lulus')->pluck('materi_id')->toArray()
                                    : [];
                                    @endphp
                                    <h6 class="fw-bold mb-3">Daftar Materi</h6>
                                    @if($materiList->count() > 0)
                                    <div class="list-group">
                                        @php $locked = false; @endphp
                                        @foreach($materiList as $idx => $m)
                                        @php
                                        $isLulus = in_array($m->id, $lulusMateriIds);
                                        $disabled = $locked;
                                        if (!$isLulus) $locked = true;
                                        @endphp
                                        <button
                                            onclick="handleMaterialClick(this, {{ $disabled ? 'true' : 'false' }})"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $disabled ? 'disabled' : '' }}"
                                            style="border: none; background: none; width: 100%; text-align: left;"
                                            data-id="{{ $m->id }}"
                                            data-title="{{ e($m->judul_materi) }}"
                                            data-url="{{ e($m->url_konten) }}"
                                            data-duration="{{ $m->durasi_menit }}"
                                            data-description="{{ e($m->deskripsi ?? '') }}"
                                            data-has-tugas="{{ $m->has_tugas ? '1' : '0' }}"
                                            data-tugas-instruksi="{{ e($m->tugas_instruksi ?? '') }}"
                                            data-tugas-soal="{{ e($m->tugas_soal ?? '') }}"
                                            {{ $disabled ? 'tabindex="-1" aria-disabled="true"' : '' }}>
                                            <div>
                                                @if($m->tipe_konten === 'video')
                                                <i class="fa-solid fa-video me-2 text-danger"></i>
                                                @elseif($m->tipe_konten === 'dokumen')
                                                <i class="fa-solid fa-file-pdf me-2 text-danger"></i>
                                                @endif
                                                <span class="{{ $isLulus ? 'text-success' : '' }}">{{ $m->judul_materi }}</span>
                                            </div>
                                            <small class="{{ $isLulus ? 'text-success' : 'text-muted' }}">{{ $m->durasi_menit ?? '—' }} menit</small>
                                        </button>
                                        @endforeach
                                    </div>
                                    <!-- Modal for locked materi -->
                                    <div class="modal fade" id="lockedMateriModal" tabindex="-1" aria-labelledby="lockedMateriModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="lockedMateriModalLabel">Materi Terkunci</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Anda harus lulus materi sebelumnya terlebih dahulu untuk mengakses materi ini.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="alert alert-info">
                                        <p class="mb-0">Belum ada materi tersedia.</p>
                                    </div>
                                    @endif

                                    <!-- Quizzes for this course (shown under Materi) -->
                                    @if($course->quiz()->count() > 0)
                                    <hr>
                                    <h6 class="fw-bold mt-3">Quiz Kursus</h6>
                                    @php
                                    // $allLulus dikirim dari controller
                                    @endphp
                                    <div class="list-group mt-2">
                                        @php
                                        // Quiz yang sudah lulus, misal dari array $lulusQuizIds
                                        $lulusQuizIds = isset($lulusQuizIds) ? $lulusQuizIds : [];
                                        @endphp
                                        @foreach($course->quiz as $qIndex => $qItem)
                                        @php $isQuizLulus = in_array($qItem->id, $lulusQuizIds); @endphp
                                        @php $isQuizLocked = !$allLulus; @endphp
                                        <a
                                            @if($isQuizLulus || $isQuizLocked)
                                            href="javascript:void(0)"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled"
                                            style="pointer-events: none; cursor: default;"
                                            tabindex="-1" aria-disabled="true"
                                            @else
                                            href="{{ route('student.quiz.show', [$course->id, $qItem->id]) }}"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                            @endif>
                                            <div>
                                                <strong class="{{ $isQuizLulus ? 'text-success' : '' }}">{{ $qItem->nama_quiz }}</strong>
                                                <div class="small {{ $isQuizLulus ? 'text-success' : 'text-muted' }}">{{ $qItem->deskripsi ?? '' }}</div>
                                                @if($isQuizLulus)
                                                <span class="badge bg-success ms-2">Lulus</span>
                                                @elseif($isQuizLocked)
                                                <span class="badge bg-secondary ms-2">Terkunci</span>
                                                @endif
                                            </div>
                                            <div class="text-end small text-muted">
                                                <div>{{ $qItem->jumlah_soal ?? '-' }} soal</div>
                                                <div>{{ $qItem->durasi_menit ?? '-' }} menit</div>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                    @endif
                                    <!-- Modal for locked quiz -->
                                    <div class="modal fade" id="lockedQuizModal" tabindex="-1" aria-labelledby="lockedQuizModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="lockedQuizModalLabel">Quiz Terkunci</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Kerjakan semua materi terlebih dahulu sebelum mengakses kuis.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fungsi JS handleQuizClick dipindahkan ke dalam <script> di bawah -->
                                    <!-- fungsi JS handleQuizClick sudah dipindahkan ke dalam <script> di bawah, baris ini dihapus agar tidak tampil sebagai teks -->

                                    {{-- Riwayat Tugas dipindah ke tab terpisah (lihat tab "Riwayat Tugas") --}}
                                </div>
                                <div id="riwayat" class="tab-pane fade">
                                    @php
                                    $materiIds = $materiList->pluck('id')->toArray();
                                    $mySubmissions = auth()->check()
                                    ? auth()->user()->materiSubmissions()->whereIn('materi_id', $materiIds)->with('materi')->orderByDesc('created_at')->get()
                                    : collect();
                                    @endphp

                                    @php
                                    $__mySubmissionsMap = [];
                                    foreach($mySubmissions as $__s) {
                                    $__mySubmissionsMap[$__s->materi_id] = [
                                    'status' => $__s->status,
                                    'id' => $__s->id,
                                    'file_path' => $__s->file_path,
                                    ];
                                    }
                                    @endphp
                                    <script>
                                        window.MY_SUBMISSIONS = @json($__mySubmissionsMap);
                                    </script>

                                    <div class="card mt-3">
                                        <div class="card-header bg-white border-0 py-2"><strong>Riwayat Tugas</strong></div>
                                        <div class="card-body p-3">
                                            <div class="list-group list-group-flush p-2">
                                                @if($mySubmissions->count() > 0)
                                                @foreach($mySubmissions as $s)
                                                <div class="submission-history-item list-group-item mb-2" data-materi-id="{{ $s->materi_id }}">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <div class="fw-bold">{{ $s->materi->judul_materi ?? 'Materi' }}</div>
                                                            <div class="small text-muted">Diupload: {{ $s->created_at->format('d-m-Y H:i') }}</div>
                                                        </div>
                                                        <div class="text-end">
                                                            @if($s->status === 'lulus')
                                                            <span class="badge bg-success">Lulus</span>
                                                            @elseif($s->status === 'tidak_lulus')
                                                            <span class="badge bg-danger">Tidak Lulus</span>
                                                            @else
                                                            <span class="badge bg-secondary">Menunggu</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <div class="small">
                                                            <div>Nilai: <strong>{{ $s->nilai !== null ? $s->nilai : '-' }}</strong></div>
                                                            <div>Komentar: <span class="text-muted">{{ $s->komentar ?? '-' }}</span></div>
                                                        </div>
                                                        <div>
                                                            @if($s->file_path)
                                                            <a href="{{ asset('storage/' . $s->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <div id="noSubmissionMessageServer" class="text-muted small p-3">Belum ada pengiriman tugas.</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
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
                            <h5 class="fw-bold mb-0" id="currentMaterialTitle">{{ $materiFirst->judul_materi ?? 'Daftar Materi' }}</h5>
                        </div>
                        <!-- Submission form for selected material -->
                        @include('pages.student._submission_form')
                    </div>
                </div>
            </div>
        </div>
</div>
</main>
</div>

<script>
    function loadMaterial(id, title, url, duration, description, hasTugas, tugasInstruksi, tugasSoal) {
        const videoPlayer = document.querySelector('.card-body p-0');
        const embedUrl = '{{ route("student.course-learn", $course->id) }}' + '?material=' + id;

        // Build embed URL from YouTube URL
        // Set current material id for submission form (if present)
        try {
            const input = document.getElementById('submission_materi_id');
            if (input) input.value = id;
            const statusSpan = document.getElementById('submissionStatus');
            if (statusSpan) statusSpan.textContent = 'Belum mengunggah untuk materi ini';

            // Update current material title in sidebar
            const currentTitleEl = document.getElementById('currentMaterialTitle');
            if (currentTitleEl) currentTitleEl.textContent = title || currentTitleEl.textContent;

            // Update tugas button visibility and data
            const viewTaskBtn = document.getElementById('viewTaskBtn');
            if (viewTaskBtn) {
                if (hasTugas) {
                    viewTaskBtn.style.display = 'inline-block';
                    viewTaskBtn.setAttribute('data-instruksi', tugasInstruksi || '');
                    viewTaskBtn.setAttribute('data-soal', tugasSoal || '');
                    viewTaskBtn.setAttribute('data-title', title || '');
                } else {
                    viewTaskBtn.style.display = 'none';
                }
            }
        } catch (e) {
            // ignore
        }
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

    function handleMaterialClick(el, isLocked) {
        if (isLocked) {
            var modal = new bootstrap.Modal(document.getElementById('lockedMateriModal'));
            modal.show();
            return;
        }
        const id = el.getAttribute('data-id');
        const title = el.getAttribute('data-title');
        const url = el.getAttribute('data-url');
        const duration = el.getAttribute('data-duration');
        const description = el.getAttribute('data-description');
        const hasTugas = el.getAttribute('data-has-tugas') === '1';
        const tugasInstruksi = el.getAttribute('data-tugas-instruksi');
        const tugasSoal = el.getAttribute('data-tugas-soal');
        loadMaterial(id, title, url, duration, description, hasTugas, tugasInstruksi, tugasSoal);
        // update submission history to show only submissions for selected materi
        try {
            updateSubmissionHistory(id);
            updateUploadState(id);
        } catch (e) {
            // ignore
        }
    }

    function updateSubmissionHistory(materiId) {
        const items = document.querySelectorAll('.submission-history-item');
        let found = 0;
        items.forEach(i => {
            const mid = i.getAttribute('data-materi-id');
            if (String(mid) === String(materiId)) {
                i.style.display = '';
                found++;
            } else {
                i.style.display = 'none';
            }
        });

        // Hide server-side generic message and show client-side message if none
        const serverMsg = document.getElementById('noSubmissionMessageServer');
        if (serverMsg) serverMsg.style.display = 'none';

        let clientMsg = document.getElementById('noSubmissionForThisMateri');
        if (!clientMsg) {
            const container = document.querySelector('.list-group.list-group-flush.p-2');
            clientMsg = document.createElement('div');
            clientMsg.id = 'noSubmissionForThisMateri';
            clientMsg.className = 'p-3 text-muted text-center';
            clientMsg.innerHTML = '';
            container.appendChild(clientMsg);
        }
        clientMsg.style.display = found ? 'none' : '';
    }

    function updateUploadState(materiId) {
        try {
            const map = window.MY_SUBMISSIONS || {};
            // If any submission in the history is pending, block uploads globally.
            // Accept multiple lexical variants (pending, menunggu) to be robust.
            let hasAnyPending = false;
            for (const k in map) {
                if (!map[k] || !map[k].status) continue;
                const st = String(map[k].status).toLowerCase();
                if (st === 'pending' || st === 'menunggu') {
                    hasAnyPending = true;
                    break;
                }
            }
            const entry = map[materiId];
            const fileInput = document.getElementById('submission_file_input');
            const uploadBtn = document.getElementById('submission_upload_btn');
            const statusSpan = document.getElementById('submissionStatus');

            if (!fileInput || !uploadBtn || !statusSpan) return;
            if (hasAnyPending) {
                // If there's any pending submission anywhere, block uploads
                fileInput.disabled = true;
                uploadBtn.disabled = true;
                statusSpan.textContent = 'Terdapat tugas yang sedang menunggu penilaian. Unggah tugas saat ini dinonaktifkan.';
                return;
            }

            if (entry && (entry.status === 'pending' || entry.status === 'lulus')) {
                // disable upload for this materi
                fileInput.disabled = true;
                uploadBtn.disabled = true;
                if (entry.status === 'pending') {
                    statusSpan.textContent = 'Anda telah mengunggah tugas untuk materi ini (Menunggu penilaian).';
                } else {
                    statusSpan.textContent = 'Anda sudah dinyatakan Lulus untuk tugas ini. Unggah tidak diperbolehkan.';
                }
            } else {
                fileInput.disabled = false;
                uploadBtn.disabled = false;
                statusSpan.textContent = 'Belum mengunggah untuk materi ini';
            }
        } catch (e) {
            // ignore
        }
    }

    // On page load, filter history to the currently selected materi (if any)
    document.addEventListener('DOMContentLoaded', function() {
        try {
            const initial = document.getElementById('submission_materi_id');
            if (initial && initial.value) {
                updateSubmissionHistory(initial.value);
                updateUploadState(initial.value);
            } else {
                // hide all by default if no initial material selected
                updateSubmissionHistory('');
                updateUploadState('');
            }
        } catch (e) {
            /* ignore */
        }

        // Set up event listener for "Lihat Soal" button
        const viewTaskBtn = document.getElementById('viewTaskBtn');
        if (viewTaskBtn) {
            viewTaskBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const instruksi = this.getAttribute('data-instruksi') || '';
                const soal = this.getAttribute('data-soal') || '';
                const title = this.getAttribute('data-title') || 'Detail Tugas';
                showTaskDetail(instruksi, soal, title);
            });
        }
    });

    // Also listen for Bootstrap tab show events to re-run checks when user opens Riwayat Tugas
    document.addEventListener('DOMContentLoaded', function() {
        try {
            const riwayatTab = document.querySelector('a[data-bs-toggle="tab"][href="#riwayat"]');
            if (riwayatTab) {
                riwayatTab.addEventListener('shown.bs.tab', function() {
                    // When riwayat tab is shown, re-evaluate upload state (global pending)
                    try {
                        updateUploadState(document.getElementById('submission_materi_id') ? document.getElementById('submission_materi_id').value : '');
                    } catch (e) {}
                });
            }

            // Setup close button for modal
            const closeButtons = document.querySelectorAll('[data-bs-dismiss="modal"]');
            closeButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const modal = bootstrap.Modal.getInstance(this.closest('.modal'));
                    if (modal) {
                        modal.hide();
                    }
                });
            });
        } catch (e) {
            // ignore
        }
    });

    // Function to display task details in modal
    function showTaskDetail(instruksi, soal, title) {
        try {
            const modalElement = document.getElementById('taskDetailModal');
            if (!modalElement) {
                console.error('Modal element not found');
                return;
            }

            // Set the content
            const titleEl = document.getElementById('modalTaskTitle');
            const instruksiEl = document.getElementById('modalTaskInstruksi');
            const soalEl = document.getElementById('modalTaskSoal');

            if (titleEl) titleEl.textContent = title || 'Detail Tugas';
            if (instruksiEl) instruksiEl.innerHTML = instruksi ? '<pre style="white-space: pre-wrap; word-wrap: break-word;">' + instruksi + '</pre>' : '<em class="text-muted">Tidak ada instruksi</em>';
            if (soalEl) soalEl.innerHTML = soal ? '<pre style="white-space: pre-wrap; word-wrap: break-word;">' + soal + '</pre>' : '<em class="text-muted">Tidak ada soal/petunjuk</em>';

            // Show modal using Bootstrap 5 API
            const modal = new bootstrap.Modal(modalElement, {
                backdrop: true,
                keyboard: true
            });
            modal.show();
        } catch (e) {
            console.error('Error showing task detail modal:', e);
        }
    }
</script>
@endsection