<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Kursus;
use App\Models\SoalQuiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Show quiz untuk student
     */
    public function show($courseId, $quizId)
    {
        $course = Kursus::findOrFail($courseId);

        // Verify student enrolled
        if (!auth()->user()->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            abort(403, 'Anda belum terdaftar di kursus ini');
        }

        $quiz = Quiz::with('soal')->findOrFail($quizId);

        // Verify quiz belongs to course
        if ($quiz->kursus_id !== $course->id) {
            abort(404);
        }

        return view('pages.student.quiz', compact('course', 'quiz'));
    }

    /**
     * Submit quiz answers
     */
    public function submit(Request $request, $courseId, $quizId)
    {
        $course = Kursus::findOrFail($courseId);

        // Verify student enrolled
        if (!auth()->user()->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            abort(403, 'Anda belum terdaftar di kursus ini');
        }

        $quiz = Quiz::findOrFail($quizId);

        // Verify quiz belongs to course
        if ($quiz->kursus_id !== $course->id) {
            abort(404);
        }

        $jawaban = $request->input('jawaban', []);
        $soal = $quiz->soal;

        $benar = 0;
        $totalSoal = $soal->count();

        foreach ($soal as $s) {
            // Get the answer for this question
            $studentAnswer = isset($jawaban[$s->id]) ? strtoupper(trim($jawaban[$s->id])) : null;
            $correctAnswer = strtoupper(trim($s->jawaban_benar));

            // Compare answers (case-insensitive)
            if ($studentAnswer === $correctAnswer) {
                $benar++;
            }
        }

        $nilai = $totalSoal > 0 ? round(($benar / $totalSoal) * 100) : 0;

        // Store quiz result in session for display
        session([
            'quiz_result' => [
                'nama_quiz' => $quiz->nama_quiz,
                'benar' => $benar,
                'total' => $totalSoal,
                'nilai' => $nilai,
                'lulus' => $nilai >= 70,
                'course_id' => $courseId,
                'quiz_id' => $quizId,
            ]
        ]);

        return redirect()->route('student.quiz-result')
            ->with('success', 'Quiz berhasil disubmit. Nilai Anda: ' . $nilai);
    }
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
