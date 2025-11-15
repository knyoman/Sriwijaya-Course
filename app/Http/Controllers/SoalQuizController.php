<?php

namespace App\Http\Controllers;

use App\Models\SoalQuiz;
use App\Models\Quiz;
use Illuminate\Http\Request;

class SoalQuizController extends Controller
{
    /**
     * Tampilkan halaman edit soal quiz
     */
    public function edit($quizId)
    {
        $quiz = Quiz::with('kursus', 'soal')->findOrFail($quizId);

        // Verify ownership
        if ($quiz->kursus->pengajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke quiz ini');
        }

        $course = $quiz->kursus;

        return view('pages.teacher.quiz-soal', compact('quiz', 'course'));
    }

    /**
     * Store soal quiz baru
     */
    public function store(Request $request, $courseId, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);

        // Verify ownership
        if ($quiz->kursus->pengajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke quiz ini');
        }

        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
            'urutan' => 'required|integer|min:1',
        ]);

        $validated['quiz_id'] = $quizId;
        SoalQuiz::create($validated);

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan');
    }

    /**
     * Update soal quiz
     */
    public function update(Request $request, $soalId)
    {
        $soal = SoalQuiz::findOrFail($soalId);
        $quiz = $soal->quiz;

        // Verify ownership
        if ($quiz->kursus->pengajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke soal ini');
        }

        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
            'urutan' => 'required|integer|min:1',
        ]);

        $soal->update($validated);

        return redirect()->back()->with('success', 'Soal berhasil diupdate');
    }

    /**
     * Delete soal quiz
     */
    public function destroy($soalId)
    {
        $soal = SoalQuiz::findOrFail($soalId);
        $quiz = $soal->quiz;

        // Verify ownership
        if ($quiz->kursus->pengajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke soal ini');
        }

        $soal->delete();

        return redirect()->back()->with('success', 'Soal berhasil dihapus');
    }
}
