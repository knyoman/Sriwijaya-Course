@extends('layouts.app')

@section('title', 'Sertifikat - ' . $certificate->nomor_sertifikat)

@section('content')
@include('components.navbar-student')
<div class="d-flex">
    @include('components.sidebar-student')
    <main style="flex: 1; margin-left: 170px; padding: 2rem;">
        <div class="container-fluid">
            <a href="{{ route('student.courses') }}" class="btn btn-outline-secondary btn-sm mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>

            <div class="row justify-content-center">
                <div class="col-md-9">
                    <!-- Certificate Display -->
                    <div class="card border-0 shadow-lg" id="sertifikat">
                        <div class="card-body p-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center; min-height: 600px; display: flex; flex-direction: column; justify-content: center;">
                            <div style="border: 3px solid white; padding: 40px; border-radius: 5px;">
                                <h1 class="fw-bold mb-3" style="font-size: 2.5rem; letter-spacing: 2px;">SERTIFIKAT</h1>
                                <p class="fs-5 mb-4">Penghargaan atas Pencapaian Akademik</p>

                                <div class="my-5 py-4" style="border-top: 2px solid white; border-bottom: 2px solid white;">
                                    <p class="mb-2" style="font-size: 1.1rem;">Dengan bangga mempersembahkan kepada</p>
                                    <h2 class="fw-bold mb-3" style="font-size: 2rem;">{{ $certificate->pelajar->nama }}</h2>
                                    <p class="fs-6">Telah berhasil menyelesaikan</p>
                                    <h3 class="fw-bold mb-4" style="font-size: 1.5rem;">{{ $certificate->nama_kursus }}</h3>
                                    <p class="fs-6">Dengan nilai: <strong style="font-size: 1.3rem;">{{ $certificate->nilai }}/100</strong></p>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <p class="small mb-1">{{ $certificate->tanggal_cetak->locale('id')->translatedFormat('d F Y') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="small mb-1">No. Sertifikat: {{ $certificate->nomor_sertifikat }}</p>
                                    </div>
                                </div>

                                <p class="small mt-4 mb-0" style="opacity: 0.9; font-size: 0.9rem;">Sertifikat ini menyatakan bahwa pemegang telah memenuhi semua persyaratan untuk menyelesaikan kursus ini.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center mt-4">
                        <button class="btn btn-primary me-2" onclick="window.print()">
                            <i class="fa-solid fa-print me-2"></i> Cetak
                        </button>
                        <button class="btn btn-warning me-2" onclick="downloadCertificateImage()">
                            <i class="fa-solid fa-download me-2"></i> Unduh Gambar
                        </button>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
                    <script>
                        function downloadCertificateImage() {
                            const certArea = document.getElementById('sertifikat');
                            html2canvas(certArea, {
                                backgroundColor: null
                            }).then(function(canvas) {
                                const link = document.createElement('a');
                                link.download = 'sertifikat.png';
                                link.href = canvas.toDataURL('image/png');
                                link.click();
                            });
                        }
                        window.addEventListener('DOMContentLoaded', function() {
                            const params = new URLSearchParams(window.location.search);
                            if (params.get('auto_download') === '1') {
                                setTimeout(downloadCertificateImage, 500);
                            }
                        });
                    </script>

                </div>

                <!-- Certificate Details -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0">Detail Sertifikat</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <small class="text-muted">Nama Peserta</small>
                                <p class="fw-bold">{{ $certificate->pelajar->nama }}</p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Kursus</small>
                                <p class="fw-bold">{{ $certificate->nama_kursus }}</p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Tanggal Lulus</small>
                                <p class="fw-bold">{{ $certificate->tanggal_cetak->locale('id')->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <small class="text-muted">Nilai</small>
                                <p class="fw-bold">{{ $certificate->nilai }}/100</p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Status</small>
                                <p class="fw-bold"><span class="badge bg-success">LULUS</span></p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">No. Sertifikat</small>
                                <p class="fw-bold">{{ $certificate->nomor_sertifikat }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <small class="text-muted">Deskripsi</small>
                                <p class="text-muted">Sertifikat ini menunjukkan bahwa pemegang telah berhasil menyelesaikan kursus {{ $certificate->nama_kursus }} dan menguasai kompetensi yang diajarkan dalam kursus ini.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mt-4">
                    <i class="fa-solid fa-info-circle me-2"></i>
                    <strong>Info:</strong> Sertifikat ini dapat dibagikan di media sosial atau CV Anda untuk menunjukkan pencapaian akademik Anda.
                </div>
            </div>
        </div>
</div>
</main>
</div>
@endsection