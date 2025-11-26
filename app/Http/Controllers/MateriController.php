<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    /**
     * Store materi baru
     */
    public function store(Request $request, $courseId)
    {
        $course = Kursus::findOrFail($courseId);

        // Verify ownership
        if ($course->pengajar_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke kursus ini');
        }

        $validated = $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
            'tipe_konten' => 'required|in:video,dokumen,kuis,live_session',
            'url_konten' => 'nullable|url',
            'durasi_menit' => 'nullable|integer|min:0',
            // assignment fields optional for teacher when creating/updating materi
            'tugas_instruksi' => 'nullable|string',
            'tugas_soal' => 'nullable|string',
            // tugas_deadline removed per request
        ]);

        $validated['kursus_id'] = $courseId;
        // Determine has_tugas based on presence of instruksi or soal
        $validated['has_tugas'] = (!empty($validated['tugas_instruksi']) || !empty($validated['tugas_soal']));

        Materi::create($validated);

        return redirect()->back()->with('success', 'Materi berhasil ditambahkan');
    }

    /**
     * Update materi
     */
    public function update(Request $request, $materiId)
    {
        $materi = Materi::findOrFail($materiId);
        $course = $materi->kursus;

        // Verify ownership
        if ($course->pengajar_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke materi ini');
        }

        $validated = $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
            'tipe_konten' => 'required|in:video,dokumen,kuis,live_session',
            'url_konten' => 'nullable|url',
            'durasi_menit' => 'nullable|integer|min:0',
            'tugas_instruksi' => 'nullable|string',
            'tugas_soal' => 'nullable|string',
        ]);

        try {
            // Determine has_tugas from provided instruksi/soal
            $validated['has_tugas'] = (!empty($validated['tugas_instruksi']) || !empty($validated['tugas_soal']));
            $materi->update($validated);
            return redirect()->back()->with('success', 'Materi berhasil diupdate');
        } catch (QueryException $e) {
            // Catat log untuk debugging
            Log::error('Gagal update materi: ' . $e->getMessage(), [
                'materi_id' => $materiId,
                'user_id' => Auth::id(),
            ]);

            // Tampilkan pesan ramah ke user
            return redirect()->back()->with('error', 'Terjadi masalah saat menyimpan data. Periksa koneksi database atau coba lagi nanti.');
        }
    }

    /**
     * Delete materi
     */
    public function destroy($materiId)
    {
        $materi = Materi::findOrFail($materiId);
        $course = $materi->kursus;

        // Verify ownership
        if ($course->pengajar_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke materi ini');
        }

        $materi->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus');
    }

    /**
     * Show single materi (teacher view)
     */
    public function show($materiId)
    {
        $materi = Materi::with('kursus.pengajar')->findOrFail($materiId);

        // verify ownership: only pengajar of the course or admin should view this teacher page
        $course = $materi->kursus;
        if ($course->pengajar_id !== \Illuminate\Support\Facades\Auth::id() && (\Illuminate\Support\Facades\Auth::user()->peran ?? '') !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini');
        }

        return view('pages.teacher.materi-show', compact('materi', 'course'));
    }
}
