<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Admin: Tampilkan daftar kursus
     */
    public function index()
    {
        $courses = Kursus::with('pengajar')->get();
        return view('pages.admin.courses', compact('courses'));
    }

    /**
     * Admin: Tampilkan form create kursus
     */
    public function create()
    {
        $pengajars = User::where('peran', 'pengajar')->get();
        return view('pages.admin.courses-create', compact('pengajars'));
    }

    /**
     * Admin: Simpan kursus baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'pengajar_id' => 'required|exists:pengguna,id',
            'durasi_jam' => 'nullable|integer|min:0',
            'image' => 'nullable|url',
            'konten' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        Kursus::create($validated);

        return redirect()->route('admin.courses')->with('success', 'Kursus berhasil ditambahkan');
    }

    /**
     * Admin: Tampilkan detail kursus
     */
    public function show($id)
    {
        $course = Kursus::with('pengajar', 'pelajar')->findOrFail($id);
        return view('pages.admin.courses-detail', compact('course'));
    }

    /**
     * Admin: Tampilkan form edit
     */
    public function edit($id)
    {
        $course = Kursus::findOrFail($id);
        $pengajars = User::where('peran', 'pengajar')->get();
        return view('pages.admin.courses-create', compact('course', 'pengajars'));
    }

    /**
     * Admin: Update kursus
     */
    public function update(Request $request, $id)
    {
        $course = Kursus::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'pengajar_id' => 'required|exists:pengguna,id',
            'durasi_jam' => 'nullable|integer|min:0',
            'image' => 'nullable|url',
            'konten' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses')->with('success', 'Kursus berhasil diupdate');
    }

    /**
     * Admin: Hapus kursus
     */
    public function destroy($id)
    {
        $course = Kursus::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.courses')->with('success', 'Kursus berhasil dihapus');
    }

    /**
     * Public: Tampilkan semua kursus di halaman courses
     */
    public function publicList()
    {
        $courses = Kursus::published()->with('pengajar')->get();
        return view('pages.courses', compact('courses'));
    }

    /**
     * Public: Detail kursus
     */
    public function publicDetail($slug)
    {
        $course = Kursus::where('slug', $slug)->published()->with('pengajar')->firstOrFail();
        return view('pages.course-detail', compact('course'));
    }

    /**
     * Student: Tampilkan semua kursus untuk student
     */
    public function studentCourses()
    {
        $courses = Kursus::published()->with('pengajar')->get();
        $enrolledCourses = auth()->user()->enrolledCourses();
        return view('pages.student.courses', compact('courses', 'enrolledCourses'));
    }

    /**
     * Student: Daftar ke kursus
     */
    public function studentEnroll($courseId)
    {
        $course = Kursus::findOrFail($courseId);
        $user = auth()->user();

        // Check jika sudah terdaftar
        if ($user->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            return redirect()->back()->with('warning', 'Anda sudah terdaftar di kursus ini');
        }

        // Daftar ke kursus
        $user->enrolledCourses()->attach($courseId, [
            'status' => 'terdaftar',
        ]);

        // Update jumlah pelajar
        $course->increment('jumlah_pelajar');

        return redirect()->back()->with('success', 'Berhasil terdaftar di kursus');
    }

    /**
     * Student: Lihat detail kursus yang sudah terdaftar
     */
    public function studentCourseLearn($courseId)
    {
        $course = Kursus::with('pengajar')->findOrFail($courseId);

        // Verify user enrolled
        if (!auth()->user()->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            abort(403, 'Anda belum terdaftar di kursus ini');
        }

        return view('pages.student.course-learn', compact('course'));
    }

    /**
     * Teacher: Lihat kursus saya
     */
    public function teacherCourses()
    {
        $courses = Kursus::byPengajar(auth()->id())->with('pelajar')->get();
        return view('pages.teacher.courses', compact('courses'));
    }
}
