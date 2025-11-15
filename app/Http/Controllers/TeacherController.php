<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;

class TeacherController extends Controller
{
    /**
     * Dashboard pengajar
     */
    public function dashboard()
    {
        return view('pages.teacher.dashboard');
    }

    /**
     * Halaman entry kursus
     */
    public function courses()
    {
        return view('pages.teacher.courses');
    }

    /**
     * Halaman materi kursus
     */
    public function courseMaterials($courseId)
    {
        $course = Kursus::with('pengajar')->findOrFail($courseId);

        // Verify ownership
        if ($course->pengajar_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke kursus ini');
        }

        return view('pages.teacher.course-materials', compact('course'));
    }

    /**
     * Halaman jadwal mentoring
     */
    public function mentoring()
    {
        return view('pages.teacher.mentoring');
    }

    /**
     * Halaman profil
     */
    public function profile()
    {
        return view('pages.teacher.profile');
    }
}
