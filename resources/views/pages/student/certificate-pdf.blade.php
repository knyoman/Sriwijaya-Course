<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $certificate->nomor_sertifikat }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: white;
        }

        .certificate {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 60px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .certificate-container {
            border: 5px solid white;
            padding: 60px;
            max-width: 900px;
            width: 100%;
        }

        .certificate h1 {
            font-size: 60px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 20px;
        }

        .certificate .subtitle {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.95;
        }

        .certificate-body {
            border-top: 3px solid white;
            border-bottom: 3px solid white;
            padding: 50px 0;
            margin: 40px 0;
        }

        .recipient-intro {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .recipient-name {
            font-size: 48px;
            font-weight: bold;
            margin: 30px 0;
        }

        .course-intro {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .course-name {
            font-size: 36px;
            font-weight: bold;
            margin: 20px 0;
        }

        .score {
            font-size: 18px;
            margin-top: 20px;
        }

        .score strong {
            font-size: 24px;
        }

        .certificate-footer {
            margin-top: 50px;
        }

        .footer-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            font-size: 14px;
        }

        .footer-text {
            font-size: 12px;
            margin-top: 30px;
            opacity: 0.9;
        }

        @page {
            margin: 0;
            size: A4 landscape;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <div class="certificate-container">
            <h1>SERTIFIKAT</h1>
            <p class="subtitle">Penghargaan atas Pencapaian Akademik</p>

            <div class="certificate-body">
                <p class="recipient-intro">Dengan bangga mempersembahkan kepada</p>
                <div class="recipient-name">{{ $certificate->pelajar->nama }}</div>
                <p class="course-intro">Telah berhasil menyelesaikan</p>
                <div class="course-name">{{ $certificate->nama_kursus }}</div>
                <p class="score">Dengan nilai: <strong>{{ $certificate->nilai }}/100</strong></p>
            </div>

            <div class="certificate-footer">
                <div class="footer-row">
                    <div>{{ $certificate->tanggal_cetak->locale('id')->translatedFormat('d F Y') }}</div>
                    <div>No. Sertifikat: {{ $certificate->nomor_sertifikat }}</div>
                </div>
                <p class="footer-text">Sertifikat ini menyatakan bahwa pemegang telah memenuhi semua persyaratan untuk menyelesaikan kursus ini.</p>
            </div>
        </div>
    </div>
</body>

</html>