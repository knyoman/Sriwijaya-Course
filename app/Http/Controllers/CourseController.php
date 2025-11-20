<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\User;
use App\Models\Mentoring;
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
     * Student: Tampilkan semua kursus untuk student (untuk enrollment)
     */
    public function studentCourses()
    {
        $courses = Kursus::published()->with('pengajar')->get();
        $enrolledCourses = auth()->user()->enrolledCourses();
        return view('pages.student.courses', compact('courses', 'enrolledCourses'));
    }

    /**
     * Student: Tampilkan kursus yang sudah didaftar (My Courses)
     */
    public function studentMyCourses()
    {
        $myCourses = auth()->user()->enrolledCourses()->with('pengajar')->get();
        return view('pages.student.my-courses', compact('myCourses'));
    }

    /**
     * Student: Riwayat Pembayaran (list pembayaran milik pelajar)
     */
    public function studentPayments()
    {
        $user = auth()->user();

        $payments = $user->enrolledCourses()->with('pengajar')->get()->map(function ($course) {
            return (object) [
                'kursus_id' => $course->id,
                'kursus_nama' => $course->nama,
                'harga' => $course->harga,
                // Override status to always Lunas for student view as requested
                'status' => 'Lunas',
            ];
        });

        return view('pages.student.payments', compact('payments'));
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
        $course = Kursus::with('pengajar', 'diskusi', 'materi')->findOrFail($courseId);

        // Verify user enrolled
        if (!auth()->user()->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            abort(403, 'Anda belum terdaftar di kursus ini');
        }

        $diskusi = $course->diskusi()->orderBy('created_at', 'desc')->get();
        $materiList = $course->materi()->orderBy('urutan')->get();
        $materiFirst = $materiList->first();

        return view('pages.student.course-learn', compact('course', 'diskusi', 'materiList', 'materiFirst'));
    }

    /**
     * Teacher: Lihat kursus saya
     */
    public function teacherCourses()
    {
        $courses = Kursus::byPengajar(auth()->id())->with('pelajar')->get();
        return view('pages.teacher.courses', compact('courses'));
    }

    /**
     * Admin: Lihat riwayat pembayaran (enrollment history)
     */
    public function adminPayments()
    {
        // Ambil semua enrollment dengan relasi ke pelajar dan kursus
        $payments = Kursus::with(['pelajar' => function ($query) {
            $query->select('pengguna.id', 'pengguna.username', 'pengguna.nama');
        }])->get()->flatMap(function ($course) {
            return $course->pelajar->map(function ($student) use ($course) {
                return (object) [
                    'id' => $course->id,
                    'pelajar_username' => $student->username,
                    'pelajar_nama' => $student->nama,
                    'kursus_nama' => $course->nama,
                    'harga' => $course->harga,
                    'created_at' => $student->pivot->created_at,
                    'status' => 'Lunas' // Default status, bisa disesuaikan dari pivot jika ada
                ];
            });
        })->sortByDesc('created_at');

        // Hitung total transaksi dan total jumlah (harga)
        $totalTransactions = $payments->count();
        $totalAmount = $payments->sum('harga');

        return view('pages.admin.payments', compact('payments', 'totalTransactions', 'totalAmount'));
    }

    /**
     * Student: Lihat jadwal mentoring
     */
    public function studentMentoring()
    {
        $mentorings = Mentoring::with('pengajar', 'kursus.pelajar')->orderBy('tanggal', 'asc')->get();
        return view('pages.student.mentoring', compact('mentorings'));
    }

    /**
     * Teacher: Lihat jadwal mentoring
     */
    public function teacherMentoring()
    {
        $mentorings = Mentoring::where('pengajar_id', auth()->id())
            ->with('pengajar', 'kursus.pelajar')
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('pages.teacher.mentoring', compact('mentorings'));
    }
}
