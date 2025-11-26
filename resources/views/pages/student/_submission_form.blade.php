<div class="card mt-4 border-0 shadow-sm">
    <div class="card-header bg-white">
        <h6 class="mb-0 fw-bold">Tugas / Praktik</h6>
    </div>
    <div class="card-body">
        <p class="small text-muted">Kirim hasil praktik Anda (PDF, DOCX, ZIP, gambar, dll). Maks 10MB.</p>
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('student.materi.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="materi_id" id="submission_materi_id" value="{{ $materiFirst->id ?? '' }}">
            <div class="mb-3">
                <input id="submission_file_input" type="file" name="file" class="form-control" required>
            </div>
            <div class="d-flex gap-2">
                <button id="submission_upload_btn" type="submit" class="btn btn-primary btn-sm">Kirim Tugas</button>
                <button id="viewTaskBtn" type="button" class="btn btn-outline-info btn-sm" style="display: none;">
                    <i class="fa-solid fa-eye me-1"></i>Lihat Soal
                </button>
            </div>
        </form>

        <div class="mt-2">
            <div id="submissionStatus" class="alert alert-warning py-2 px-3 small mb-0">@if(session('error')){{ session('error') }}@else Belum mengunggah untuk materi ini @endif</div>
        </div>
    </div>
</div>

<script>
    // Initialize submission task area if first material has tugas
    (function() {
        try {
            <?php
            $__firstHas = isset($materiFirst) && (bool)($materiFirst->has_tugas ?? false);
            $__instruksi = isset($materiFirst) ? $materiFirst->tugas_instruksi : '';
            $__soal = isset($materiFirst) ? $materiFirst->tugas_soal : '';
            $__title = isset($materiFirst) ? $materiFirst->judul_materi : '';
            ?>
            const firstHas = <?php echo json_encode($__firstHas); ?>;
            const instruksi = <?php echo json_encode($__instruksi); ?>;
            const soal = <?php echo json_encode($__soal); ?>;
            const title = <?php echo json_encode($__title); ?>;

            if (firstHas) {
                const viewBtn = document.getElementById('viewTaskBtn');
                if (viewBtn) {
                    viewBtn.style.display = 'inline-block';
                    // Store data in button for later use
                    viewBtn.setAttribute('data-instruksi', instruksi);
                    viewBtn.setAttribute('data-soal', soal);
                    viewBtn.setAttribute('data-title', title);
                }
            }
        } catch (e) {
            // ignore
        }
    })();
</script>