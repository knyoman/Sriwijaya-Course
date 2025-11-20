<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Quiz;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    /**
     * Generate and store certificate
     */
    public function store(Request $request, $courseId, $quizId)
    {
        $course = Kursus::findOrFail($courseId);
        $quiz = Quiz::findOrFail($quizId);
        $nilai = session('quiz_result.nilai', 0);

        // Verify student enrolled and passed
        if (!auth()->user()->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            abort(403, 'Anda belum terdaftar di kursus ini');
        }

        if ($nilai < 70) {
            abort(403, 'Anda harus lulus quiz untuk mendapatkan sertifikat');
        }

        // Generate certificate number
        $nomorSertifikat = 'CERT-' . date('Y') . '-' . str_pad(Certificate::count() + 1, 5, '0', STR_PAD_LEFT);

        // Check if certificate already exists for this quiz attempt
        $existingCert = Certificate::where('pelajar_id', auth()->id())
            ->where('quiz_id', $quizId)
            ->where('kursus_id', $courseId)
            ->first();

        if ($existingCert) {
            return redirect()->route('student.certificate.show', $existingCert->id)
                ->with('info', 'Sertifikat sudah tersimpan sebelumnya');
        }

        // Create certificate
        $certificate = Certificate::create([
            'pelajar_id' => auth()->id(),
            'quiz_id' => $quizId,
            'kursus_id' => $courseId,
            'nama_kursus' => $course->nama,
            'nilai' => $nilai,
            'nomor_sertifikat' => $nomorSertifikat,
            'tanggal_cetak' => now(),
        ]);

        return redirect()->route('student.certificate.show', $certificate->id)
            ->with('success', 'Sertifikat berhasil disimpan');
    }

    /**
     * Show certificate
     */
    public function show($certificateId)
    {
        $certificate = Certificate::with('pelajar', 'quiz', 'kursus')->findOrFail($certificateId);

        // Verify ownership
        if ($certificate->pelajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke sertifikat ini');
        }

        return view('pages.student.certificate-show', compact('certificate'));
    }

    /**
     * Download certificate as PDF
     */
    public function download($certificateId)
    {
        $certificate = Certificate::findOrFail($certificateId);

        // Verify ownership
        if ($certificate->pelajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke sertifikat ini');
        }

        $pdf = PDF::loadView('pages.student.certificate-pdf', compact('certificate'));
        return $pdf->download('Sertifikat_' . $certificate->nomor_sertifikat . '.pdf');
    }

    /**
     * List user certificates
     */
    public function index()
    {
        $certificates = Certificate::where('pelajar_id', auth()->id())
            ->with('kursus', 'quiz')
            ->orderBy('tanggal_cetak', 'desc')
            ->get();

        return view('pages.student.certificates', compact('certificates'));
    }
}
