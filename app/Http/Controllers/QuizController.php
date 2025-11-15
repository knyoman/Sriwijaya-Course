<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Kursus;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Store quiz baru
     */
    public function store(Request $request, $courseId)
    {
        $course = Kursus::findOrFail($courseId);

        // Verify ownership
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke kursus ini');
        }

        $validated = $request->validate([
            'nama_quiz' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah_soal' => 'required|integer|min:1',
            'durasi_menit' => 'required|integer|min:1',
            'urutan' => 'required|integer|min:1',
        ]);

        $validated['kursus_id'] = $courseId;
        Quiz::create($validated);

        return redirect()->back()->with('success', 'Quiz berhasil ditambahkan');
    }

    /**
     * Update quiz
     */
    public function update(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $course = $quiz->kursus;

        // Verify ownership
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke quiz ini');
        }

        $validated = $request->validate([
            'nama_quiz' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah_soal' => 'required|integer|min:1',
            'durasi_menit' => 'required|integer|min:1',
            'urutan' => 'required|integer|min:1',
        ]);

        $quiz->update($validated);

        return redirect()->back()->with('success', 'Quiz berhasil diupdate');
    }

    /**
     * Delete quiz
     */
    public function destroy($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $course = $quiz->kursus;

        // Verify ownership
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke quiz ini');
        }

        $quiz->delete();

        return redirect()->back()->with('success', 'Quiz berhasil dihapus');
    }
}
