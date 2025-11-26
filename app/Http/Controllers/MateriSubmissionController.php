<?php

namespace App\Http\Controllers;

use App\Models\MateriSubmission;
use App\Models\Materi;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriSubmissionController extends Controller
{
    // Store student submission
    public function store(Request $request)
    {
        $request->validate([
            'materi_id' => 'required|integer|exists:materi,id',
            'file' => 'required|file|max:10240', // max 10MB
        ]);

        $materi = Materi::findOrFail($request->materi_id);
        $user = Auth::user();

        // Prevent upload if student already has a pending submission or has passed (lulus)
        $exists = MateriSubmission::where('materi_id', $materi->id)
            ->where('pelajar_id', $user->id)
            ->whereIn('status', ['pending', 'lulus'])
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengunggah tugas karena pengiriman Anda sedang menunggu penilaian atau sudah Lulus.');
        }

        // store file in public disk
        $path = $request->file('file')->store('materi_submissions', 'public');

        $submission = MateriSubmission::create([
            'materi_id' => $materi->id,
            'pelajar_id' => $user->id,
            'file_path' => $path,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil diunggah. Tunggu penilaian pengajar.');
    }

    // Teacher: list submissions for a course
    public function indexForCourse($courseId)
    {
        $course = Kursus::findOrFail($courseId);
        if ($course->pengajar_id !== Auth::id()) abort(403);

        // Order so that pending submissions appear first, then newest
        $submissions = MateriSubmission::whereIn('materi_id', $course->materi()->pluck('id'))
            ->with('pelajar', 'materi')
            ->orderByRaw("(status = 'pending') DESC")
            ->orderByDesc('created_at')
            ->get();

        return view('pages.teacher.materi-submissions', compact('course', 'submissions'));
    }

    // Teacher: grade submission
    public function grade(Request $request, $submissionId)
    {
        $request->validate([
            'status' => 'required|in:lulus,tidak_lulus',
            'nilai' => 'nullable|numeric|min:0|max:100',
            'komentar' => 'nullable|string',
        ]);

        $submission = MateriSubmission::findOrFail($submissionId);
        $course = $submission->materi->kursus;
        if ($course->pengajar_id !== Auth::id()) abort(403);

        $submission->update([
            'status' => $request->status,
            'nilai' => $request->nilai,
            'komentar' => $request->komentar,
        ]);

        return redirect()->back()->with('success', 'Penilaian tersimpan.');
    }
}
