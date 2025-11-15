<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Kursus;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Store materi baru
     */
    public function store(Request $request, $courseId)
    {
        $course = Kursus::findOrFail($courseId);

        // Verify ownership
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke kursus ini');
        }

        $validated = $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
            'tipe_konten' => 'required|in:video,dokumen,kuis,live_session',
            'url_konten' => 'nullable|url',
            'durasi_menit' => 'nullable|integer|min:0',
        ]);

        $validated['kursus_id'] = $courseId;
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
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke materi ini');
        }

        $validated = $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
            'tipe_konten' => 'required|in:video,dokumen,kuis,live_session',
            'url_konten' => 'nullable|url',
            'durasi_menit' => 'nullable|integer|min:0',
        ]);

        $materi->update($validated);

        return redirect()->back()->with('success', 'Materi berhasil diupdate');
    }

    /**
     * Delete materi
     */
    public function destroy($materiId)
    {
        $materi = Materi::findOrFail($materiId);
        $course = $materi->kursus;

        // Verify ownership
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke materi ini');
        }

        $materi->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus');
    }
}
