<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $certificate->nomor_sertifikat }}</title>
    @php
    $logoPath = public_path('Image/Logo.png');
    $logoTabPath = public_path('Image/LogoTab.png');
    $ttdPath = public_path('Image/ttd.png');
    $logo = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
    $logoTab = file_exists($logoTabPath) ? base64_encode(file_get_contents($logoTabPath)) : null;

    // Try to find per-course or per-user signature images before falling back
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

    // QR code: generate verification URL and attempt to fetch a QR image via Google Chart API
    $verifyUrl = url('/certificates/' . $certificate->nomor_sertifikat);
    $qrImage = null;
    try {
    $qrApi = 'https://chart.googleapis.com/chart?chs=180x180&cht=qr&chl=' . urlencode($verifyUrl) . '&choe=UTF-8';
    $qrData = @file_get_contents($qrApi);
    if ($qrData) {
    $qrImage = base64_encode($qrData);
    }
    } catch (\Throwable $e) {
    $qrImage = null;
    }

    // Optional local font embedding: looks for public/fonts/Poppins-Regular.ttf
    $fontPath = public_path('fonts/Poppins-Regular.ttf');
    $fontData = file_exists($fontPath) ? base64_encode(file_get_contents($fontPath)) : null;
    @endphp
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            font-family: 'Arial', sans-serif;
        }

        /* Outer dark frame to mimic border */
        .page {
            background: #203142;
            padding: 28px;
            /* frame width */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Inner paper */
        .paper {
            background: #ffffff;
            width: 100%;
            max-width: 1180px;
            padding: 36px;
            position: relative;
            border: 6px solid #2a3b4a;
            /* inner border */
        }

        /* Subtle wavy pattern background */
        .paper:before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: repeating-linear-gradient(135deg, rgba(0, 0, 0, 0.02) 0 10px, transparent 10px 20px);
            pointer-events: none;
            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 1;
            color: #0b2b3a;
        }

        .top-left-logo {
            position: absolute;
            top: 28px;
            left: 28px;
            width: 160px;
        }

        .ribbon-right {
            position: absolute;
            right: -38px;
            top: 0;
            width: 220px;
            height: 320px;
            background: #233541;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 50% 100%, 0 85%);
        }

        .ribbon-right h4 {
            font-size: 14px;
            text-align: center;
            letter-spacing: 0.6px;
        }

        .ribbon-emblem {
            width: 85px;
            height: 85px;
            background: #ffffff12;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 12px;
        }

        .main-title {
            margin-top: 40px;
        }

        .main-title h1 {
            font-size: 42px;
            letter-spacing: 2px;
            color: #0c2e3a;
        }

        .subtitle {
            color: #6b7a84;
            margin-top: 6px;
        }

        .body-area {
            margin-top: 50px;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 30px;
            align-items: start;
        }

        .left {
            padding-right: 20px;
        }

        .cert-id {
            display: inline-block;
            background: #233541;
            color: #fff;
            padding: 7px 12px;
            border-radius: 6px;
            font-size: 12px;
            margin-bottom: 12px;
        }

        .recipient-intro {
            color: #20313a;
            margin-top: 8px;
        }

        .recipient-name {
            font-size: 34px;
            color: #00a9b5;
            font-weight: 700;
            margin-top: 12px;
        }

        .course-intro {
            margin-top: 10px;
            color: #20313a
        }

        .course-name {
            color: #00a9b5;
            font-weight: 700;
            margin-top: 8px;
            font-size: 20px
        }

        .footer-area {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 70px;
        }

        .signature-block {
            text-align: left;
        }

        .signature-img {
            width: 200px;
            height: auto;
            object-fit: contain;
        }

        .signature-name {
            font-weight: 700;
            margin-top: 6px
        }

        .signature-title {
            font-size: 12px;
            color: #58636a
        }

        .qr-block {
            text-align: right;
            font-size: 11px;
            color: #4b5a61
        }

        @page {
            margin: 0;
            size: A4 landscape;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="paper">
            <div class="content">
                @if($logo)
                <img class="top-left-logo" src="data:image/png;base64,{{ $logo }}" alt="logo">
                @endif

                <div class="ribbon-right">
                    <h4>SERTIFIKAT\nKOMPETENSI\nKELULUSAN</h4>
                    <div class="ribbon-emblem">
                        @if($logoTab)
                        <img src="data:image/png;base64,{{ $logoTab }}" style="width:56px;height:56px;object-fit:contain" alt="emblem">
                        @endif
                    </div>
                </div>

                <div class="main-title">
                    <h1>SERTIFIKAT</h1>
                    <div class="subtitle">Penghargaan atas Pencapaian Akademik</div>
                </div>

                <div class="body-area">
                    <div class="left">
                        <div class="cert-id">{{ $certificate->nomor_sertifikat }}</div>
                        <div class="recipient-intro">Diberikan kepada</div>
                        <div class="recipient-name">{{ strtoupper($certificate->pelajar->nama) }}</div>
                        <div class="course-intro">Atas kelulusannya pada kelas</div>
                        <div class="course-name">{{ $certificate->nama_kursus }}</div>
                    </div>

                    <div class="right">
                        <div style="height:140px"></div>
                        <div style="text-align:right;color:#20313a">Tanggal: {{ $certificate->tanggal_cetak->locale('id')->translatedFormat('d F Y') }}</div>
                        <div style="height:18px"></div>
                        <div style="text-align:right;">
                            @if($logoTab)
                            <div style="display:inline-block;background:#fff;padding:8px;border-radius:6px">
                                <img src="data:image/png;base64,{{ $logoTab }}" style="width:86px;height:86px;object-fit:contain" alt="seal">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="footer-area">
                    <div class="signature-block">
                        @if($ttd)
                        <img class="signature-img" src="data:image/png;base64,{{ $ttd }}" alt="ttd">
                        @else
                        <div style="height:70px"></div>
                        @endif
                        <div class="signature-name">{{ config('app.name') }}</div>
                        <div class="signature-title">Chief Executive Officer</div>
                    </div>

                    <div class="qr-block">
                        <div style="margin-bottom:6px">Verifikasi Sertifikat</div>
                        @if($qrImage)
                        <img src="data:image/png;base64,{{ $qrImage }}" style="width:88px;display:block;margin-bottom:6px" alt="qr">
                        @endif
                        <div style="font-size:10px">{{ $verifyUrl }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>