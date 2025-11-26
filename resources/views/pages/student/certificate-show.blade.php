@extends('layouts.app')

@section('title', 'Sertifikat - ' . $certificate->nomor_sertifikat)

@section('content')
@include('components.navbar-student')

<div class="d-flex">
    <!-- Sidebar intentionally hidden on certificate page to allow full-width certificate -->

    <main style="flex: 1; margin-left: 0; background-color: #e9ecef; min-height: 100vh; padding: 2.5rem 1.5rem; padding-top: 70px;">
        <div class="container-fluid">

            {{-- Back button moved to bottom (replaces Cetak PDF) --}}

            @php
            // --- DATA PREPARATION ---
            $logoPath = public_path('Image/Logo.png');
            $logoTabPath = public_path('Image/LogoCertif.png');
            $ttdPath = public_path('Image/ttd.png');
            // Gambar pattern untuk tekstur kertas (base64 kecil)
            $noisePattern = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAAUVBMVEWFhYWDg4N3d3dtbW17e3t1dXV0dHR4eHh2dnZxcXFycXFzc3N6enp8fHx5eXl9fX1+fn5vb29wcHBgYGB/f39xcXFycXFzc3N0dHR1dXV8Iw3HAAAAG3RSTlNAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEAvzkYiAAAAcElEQVR4Ae3QwQ2DMAwE0YfylAu6/6q0gARKyAmRx52sd761A+89+7T35vK59j7u9LzX5nnV616b57+61/q51+b5rfZ9/6t9n0e977P2ff6r/d5/td/7q/Z7/6t9n0e977P2ff6r/d5/td/7q/Z7H82vB67mFRD4AAAAAElFTkSuQmCC';


            $logo = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
            $logoTab = file_exists($logoTabPath) ? base64_encode(file_get_contents($logoTabPath)) : null;

            $ttdCandidates = [
            public_path('Image/ttd_course_' . $certificate->kursus_id . '.png'),
            public_path('Image/ttd_' . $certificate->kursus_id . '.png'),
            public_path('Image/ttd_user_' . $certificate->pelajar_id . '.png'),
            $ttdPath,
            ];
            $ttd = null;
            foreach ($ttdCandidates as $candidate) {
            if (file_exists($candidate)) {
            $ttd = base64_encode(file_get_contents($candidate));
            break;
            }
            }

            $verifyUrl = url('/certificates/' . $certificate->nomor_sertifikat);
            $qrImage = null;
            try {
            $qrApi = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . urlencode($verifyUrl) . '&choe=UTF-8';
            $qrData = @file_get_contents($qrApi);
            if ($qrData) $qrImage = base64_encode($qrData);
            } catch (\Throwable $e) {}
            // --- END DATA PREPARATION ---
            @endphp

            <style>
                @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Lato:wght@300;400;700&display=swap');

                :root {
                    --primary-color: #0056b3;
                    --accent-color: #c5a026;
                    --text-dark: #212529;
                    --text-muted: #6c757d;
                    --cert-bg-color: #fffcf8;
                }

                .certificate-wrapper {
                    width: 100%;
                    display: flex;
                    justify-content: center;
                    padding: 0 20px 30px 20px;
                    box-sizing: border-box;
                }

                #sertifikat-node {
                    position: relative;
                    width: 100%;
                    max-width: 1123px;
                    /* don't exceed A4 width */
                    aspect-ratio: 1123 / 794;
                    height: auto;
                    background-color: var(--cert-bg-color);
                    background-image: url('{{ $noisePattern }}');
                    background-repeat: repeat;
                    background-blend-mode: multiply;
                    color: var(--text-dark);
                    font-family: 'Lato', sans-serif;
                    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
                    overflow: hidden;
                    box-sizing: border-box;
                    padding: 15px;
                    margin: 0 auto;
                }

                /* Border Dalam Biru & Background Watermark */
                .cert-inner-border {
                    width: 100%;
                    height: 100%;
                    border: 6px solid var(--primary-color);
                    position: relative;
                    padding: 40px;
                    box-sizing: border-box;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    /* Gradien halus di pinggiran dalam */
                    background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0) 50%, rgba(0, 86, 179, 0.05) 100%);
                    z-index: 1;
                }

                /* WATERMARK LOGO DI TENGAH */
                .cert-inner-border::before {
                    content: "";
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) rotate(-10deg);
                    width: 60%;
                    height: 60%;
                    @if($logo) background-image: url('data:image/png;base64,{{ $logo }}');
                    @endif background-position: center;
                    background-size: contain;
                    background-repeat: no-repeat;
                    opacity: 0.04;
                    z-index: -1;
                    pointer-events: none;
                    filter: grayscale(100%);
                }


                /* Hiasan Sudut Emas */
                .corner-decoration {
                    position: absolute;
                    width: 120px;
                    height: 120px;
                    border: 3px solid var(--accent-color);
                    z-index: 0;
                    pointer-events: none;
                }

                /* Sudut Kiri Atas dengan bentuk L */
                .top-left {
                    top: 25px;
                    left: 25px;
                    border-right: none;
                    border-bottom: none;
                }

                /* Sudut Kanan Bawah dengan bentuk L terbalik */
                .bottom-right {
                    bottom: 25px;
                    right: 25px;
                    border-left: none;
                    border-top: none;
                }

                /* Konten Sertifikat (Agar berada di atas background) */
                .cert-content-layer {
                    position: relative;
                    z-index: 5;
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }

                /* --- Header Area --- */
                .cert-header {
                    text-align: center;
                }

                .logo-img {
                    height: 65px;
                    width: auto;
                    margin-bottom: 10px;
                    max-width: 45%;
                }

                .cert-title {
                    font-family: 'Playfair Display', serif;
                    font-size: 44px;
                    font-weight: 700;
                    color: var(--primary-color);
                    text-transform: uppercase;
                    letter-spacing: 3px;
                    margin: 0;
                    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
                }

                .cert-subtitle {
                    font-size: 15px;
                    color: var(--text-muted);
                    letter-spacing: 5px;
                    text-transform: uppercase;
                    margin-top: 5px;
                    font-weight: 300;
                }

                /* --- Body Area --- */
                .cert-body {
                    text-align: center;
                    flex: 1;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                }

                .presented-to {
                    font-size: 17px;
                    margin-bottom: 10px;
                    color: var(--text-muted);
                    font-style: italic;
                }

                .student-name {
                    font-family: 'Playfair Display', serif;
                    font-size: 50px;
                    font-weight: 700;
                    color: var(--text-dark);
                    margin: 10px auto 20px auto;
                    border-bottom: 3px double var(--accent-color);
                    display: inline-block;
                    padding-bottom: 5px;
                    max-width: 90%;
                    word-wrap: break-word;
                    line-height: 1.05;
                }

                .completion-text {
                    font-size: 18px;
                    margin-bottom: 15px;
                    color: var(--text-dark);
                    line-height: 1.4;
                }

                .course-name {
                    font-size: 34px;
                    font-weight: 700;
                    color: var(--primary-color);
                    margin-bottom: 20px;
                    font-family: 'Playfair Display', serif;
                }

                .cert-id {
                    font-family: 'Courier New', monospace;
                    background: rgba(255, 255, 255, 0.7);
                    padding: 6px 15px;
                    border-radius: 4px;
                    color: var(--text-muted);
                    font-size: 13px;
                    display: inline-block;
                    border: 1px solid #e0e0e0;
                }

                /* --- Footer Area --- */
                .cert-footer {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-end;
                    margin-top: 20px;
                }

                .signature-block {
                    text-align: left;
                    min-width: 180px;
                }

                .signature-img {
                    height: 85px;
                    margin-bottom: -10px;
                    display: block;
                }

                .signatory-line {
                    width: 100%;
                    height: 2px;
                    background: var(--text-dark);
                    margin-bottom: 5px;
                }

                .signatory-name {
                    font-weight: 700;
                    font-size: 18px;
                    color: var(--primary-color);
                }

                .signatory-title {
                    font-size: 13px;
                    color: var(--text-muted);
                }

                .qr-block {
                    text-align: right;
                    min-width: 150px;
                }

                .qr-img {
                    width: 85px;
                    height: 85px;
                    border: 3px solid #fff;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }

                /* Badge / Seal di Pojok Kanan Atas */
                .badge-seal {
                    position: absolute;
                    top: 40px;
                    right: 40px;
                    width: 110px;
                    height: 110px;
                    z-index: 10;
                    filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));
                }

                /* Prevent page-level horizontal scrolling caused by this component */
                html,
                body,
                main {
                    overflow-x: hidden;
                }

                /* Responsive tweaks for narrow viewports */
                @media (max-width: 900px) {
                    #sertifikat-node {
                        padding: 10px;
                    }

                    .cert-inner-border {
                        padding: 20px;
                    }

                    .logo-img {
                        height: 50px;
                    }

                    .cert-title {
                        font-size: 30px;
                    }

                    .student-name {
                        font-size: 32px;
                    }

                    .course-name {
                        font-size: 22px;
                    }

                    .cert-subtitle {
                        letter-spacing: 2px;
                        font-size: 12px;
                    }

                    .badge-seal {
                        width: 80px;
                        height: 80px;
                        top: 20px;
                        right: 20px;
                    }

                    .cert-footer {
                        flex-direction: column;
                        gap: 12px;
                        align-items: flex-start;
                    }

                    .qr-block {
                        text-align: left;
                    }
                }

                /* Print Config */
                @media print {
                    @page {
                        size: landscape;
                        margin: 0;
                    }

                    body,
                    .d-print-none {
                        display: none !important;
                    }

                    #sertifikat-node {
                        display: block !important;
                        visibility: visible;
                        position: fixed;
                        top: 0;
                        left: 0;
                        margin: 0;
                        box-shadow: none;
                        padding: 0;
                        width: 100% !important;
                        height: 100% !important;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }

                    .cert-inner-border {
                        margin: 10px;
                        height: calc(100% - 20px);
                        width: calc(100% - 20px);
                    }
                }
            </style>

            <div class="certificate-wrapper">
                <div id="sertifikat-node">
                    <div class="corner-decoration top-left"></div>
                    <div class="corner-decoration bottom-right"></div>
                    <div class="cert-inner-border">
                        @if($logoTab)
                        <div class="badge-seal">
                            <img src="data:image/png;base64,{{ $logoTab }}" style="width:100%; height:auto;" alt="Seal">
                        </div>
                        @endif

                        <div class="cert-content-layer">

                            <div class="cert-header">
                                @if($logo)
                                <img src="data:image/png;base64,{{ $logo }}" class="logo-img" alt="Logo">
                                @else
                                <h3 style="color:var(--primary-color); font-weight:800;">SRIWIJAYA COURSE</h3>
                                @endif
                                <h1 class="cert-title">Sertifikat Kelulusan</h1>
                                <div class="cert-subtitle">Certificate of Completion</div>
                            </div>

                            <div class="cert-body">
                                <div class="presented-to">Diberikan kepada / Presented to:</div>

                                <div class="student-name">
                                    {{ $certificate->pelajar->nama }}
                                </div>

                                <div class="completion-text">
                                    Telah berhasil menyelesaikan semua persyaratan pada kursus:<br>
                                    <i>Has successfully completed all requirements for the course:</i>
                                </div>

                                <div class="course-name">
                                    {{ $certificate->nama_kursus }}
                                </div>

                                @if(!is_null($certificate->nilai) && $certificate->nilai !== '')
                                <div style="font-weight:600; color:var(--accent-color); margin-bottom:15px; font-size: 18px;">
                                    Nilai Akhir / Final Score: {{ is_numeric($certificate->nilai) ? number_format($certificate->nilai, 0) : $certificate->nilai }}/100
                                </div>
                                @endif

                                <div>
                                    <span class="cert-id">No. Sertifikat: {{ $certificate->nomor_sertifikat }}</span>
                                </div>
                            </div>

                            <div class="cert-footer">
                                <div class="signature-block">
                                    <div style="font-size:15px; margin-bottom:5px; font-weight: 500;">
                                        Palembang, {{ $certificate->tanggal_cetak->locale('id')->translatedFormat('d F Y') }}
                                    </div>

                                    @if($ttd)
                                    <img class="signature-img" src="data:image/png;base64,{{ $ttd }}" alt="TTD">
                                    @else
                                    <div style="height:85px;"></div>
                                    @endif

                                    <div class="signatory-line"></div>
                                    <div class="signatory-name">Dewa Rizky</div>
                                    <div class="signatory-title">CEO, Sriwijaya Course</div>
                                </div>

                                <div class="qr-block">
                                    @if($qrImage)
                                    <img class="qr-img" src="data:image/png;base64,{{ $qrImage }}" alt="QR">
                                    @endif
                                    <div style="font-size:11px; margin-top:8px; color:var(--text-dark); font-weight:600;">Scan untuk Verifikasi</div>
                                    <div style="font-size:10px; color:var(--text-muted);">Berlaku s/d: {{ $certificate->tanggal_cetak->addYears(3)->format('Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 pb-5 d-print-none">
                <a href="{{ route('student.courses') }}" class="btn btn-secondary btn-lg px-5 me-3 shadow-sm">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
                <button class="btn btn-success btn-lg px-5 shadow-sm" onclick="downloadImage()">
                    <i class="fa-solid fa-image me-2"></i> Unduh JPGHQ
                </button>
            </div>

        </div>
    </main>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadImage() {
        const node = document.getElementById('sertifikat-node');
        const btn = document.querySelector('.btn-success');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Memproses...';
        btn.disabled = true;

        // Hilangkan shadow saat di-capture agar lebih bersih
        const originalShadow = node.style.boxShadow;
        node.style.boxShadow = 'none';

        html2canvas(node, {
            scale: 3,
            useCORS: true,
            allowTaint: true,
            backgroundColor: null,
        }).then(canvas => {
            node.style.boxShadow = originalShadow;

            const link = document.createElement('a');
            const certNo = '{{ $certificate->nomor_sertifikat }}'.replace(/[^a-zA-Z0-9]/g, '-');
            link.download = `Sertifikat-${certNo}.jpg`;
            link.href = canvas.toDataURL('image/jpeg', 0.95);
            link.click();

            btn.innerHTML = originalText;
            btn.disabled = false;
        }).catch(err => {
            console.error("Gagal generate gambar:", err);
            btn.innerHTML = 'Gagal. Coba Lagi.';
            btn.disabled = false;
            node.style.boxShadow = originalShadow;
        });
    }
</script>

@endsection