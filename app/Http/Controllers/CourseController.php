<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
        $courses = Kursus::with('pengajar')
            ->withCount('pelajar')
            ->get();
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
        $courses = Kursus::published()
            ->with('pengajar')
            ->withCount('pelajar')
            ->get();
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
        $courses = Kursus::published()
            ->with('pengajar')
            ->withCount('pelajar')
            ->get();
        $enrolledCourses = Auth::user()->enrolledCourses();
        return view('pages.student.courses', compact('courses', 'enrolledCourses'));
    }

    /**
     * Student: Tampilkan kursus yang sudah didaftar (My Courses)
     */
    public function studentMyCourses()
    {
        $myCourses = Auth::user()->enrolledCourses()->with('pengajar')->get();
        return view('pages.student.my-courses', compact('myCourses'));
    }

    /**
     * Student: Riwayat Pembayaran (list pembayaran milik pelajar)
     */
    public function studentPayments()
    {
        $user = Auth::user();

        $payments = $user->enrolledCourses()->with('pengajar')->get()->map(function ($course) {
            return (object) [
                'kursus_id' => $course->id,
                'kursus_nama' => $course->nama,
                'harga' => $course->harga,
                'metode_pembayaran' => $course->pivot->metode_pembayaran ?? '-',
                'status' => $course->pivot->status_pembayaran === 'lunas' ? 'Lunas' : ucfirst($course->pivot->status_pembayaran ?? 'Pending'),
                'tanggal_daftar' => $course->pivot->created_at ? $course->pivot->created_at->format('d-m-Y H:i') : '-',
            ];
        });

        return view('pages.student.payments', compact('payments'));
    }

    /**
     * Student: Daftar ke kursus
     */
    // Tampilkan form pilih metode pembayaran
    public function studentEnroll($courseId)
    {
        $course = Kursus::findOrFail($courseId);
        $user = Auth::user();

        // Check jika sudah terdaftar
        if ($user->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            return redirect()->back()->with('warning', 'Anda sudah terdaftar di kursus ini');
        }

        return view('pages.student.payment-method', compact('course'));
    }

    // Proses simpan pendaftaran & pembayaran
    public function studentEnrollProcess(Request $request, $courseId)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string',
        ]);
        $course = Kursus::findOrFail($courseId);
        $user = Auth::user();

        if ($user->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            return redirect()->route('student.courses')->with('warning', 'Anda sudah terdaftar di kursus ini');
        }

        $user->enrolledCourses()->attach($courseId, [
            'status' => 'terdaftar',
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => 'lunas',
        ]);
        $course->increment('jumlah_pelajar');

        return redirect()->route('student.payments')->with('success', 'Pendaftaran berhasil, silakan lakukan pembayaran.');
    }

    /**
     * Student: Lihat detail kursus yang sudah terdaftar
     */
    public function studentCourseLearn($courseId)
    {
        $course = Kursus::with('pengajar', 'diskusi', 'materi', 'quiz')->findOrFail($courseId);

        // Pastikan user adalah instance App\Models\User
        $user = Auth::user();
        if (!($user instanceof \App\Models\User)) {
            $user = User::find($user->id);
        }

        // Verify user enrolled
        if (!$user->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            abort(403, 'Anda belum terdaftar di kursus ini');
        }

        $diskusi = $course->diskusi()->orderBy('created_at', 'desc')->get();
        $materiList = $course->materi()->orderBy('urutan')->get();
        $materiFirst = $materiList->first();

        // Ambil quiz yang sudah lulus dari certificate
        $lulusQuizIds = $user->certificates()->where('kursus_id', $courseId)->pluck('quiz_id')->toArray();

        // Ambil materi yang sudah lulus
        $materiIds = $course->materi()->pluck('id')->toArray();
        $lulusMateriIds = $user->materiSubmissions()
            ->where('status', 'lulus')
            ->whereIn('materi_id', $materiIds)
            ->pluck('materi_id')
            ->unique()
            ->toArray();

        // Logic: Quiz hanya unlock jika semua materi sudah lulus
        $allLulus = count($materiIds) > 0 && count($lulusMateriIds) === count($materiIds);

        return view('pages.student.course-learn', compact('course', 'diskusi', 'materiList', 'materiFirst', 'lulusQuizIds', 'lulusMateriIds', 'allLulus'));
    }

    /**
     * Teacher: Lihat kursus saya
     */
    public function teacherCourses()
    {
        $courses = Kursus::byPengajar(Auth::id())
            ->with('pelajar')
            ->withCount('pelajar')
            ->get();
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
                    'student_id' => $student->id,
                    'pelajar_username' => $student->username,
                    'pelajar_nama' => $student->nama,
                    'kursus_nama' => $course->nama,
                    'harga' => $course->harga,
                    'metode_pembayaran' => $student->pivot->metode_pembayaran ?? '-',
                    'tanggal_daftar' => $student->pivot->created_at ? $student->pivot->created_at->format('d-m-Y H:i') : '-',
                    'status' => $student->pivot->status_pembayaran === 'lunas' ? 'Lunas' : ucfirst($student->pivot->status_pembayaran ?? 'Pending'),
                    'created_at' => $student->pivot->created_at,
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
        $user = Auth::user();

        // Ambil daftar kursus yang diikuti pelajar
        // gunakan penamaan tabel agar kolom 'id' tidak ambigu saat join
        $enrolledCourseIds = $user->enrolledCourses()->pluck('kursus.id')->toArray();

        // Jika tidak ada kursus yang diikuti, kembalikan koleksi kosong
        if (empty($enrolledCourseIds)) {
            $mentorings = collect();
        } else {
            // Ambil mentoring yang berkaitan dengan kursus yang diikuti pelajar
            // Urutkan sehingga: Sedang Berlangsung -> Belum -> Sudah, lalu berdasarkan tanggal
            $mentorings = Mentoring::with('pengajar', 'kursus.pelajar', 'feedbacks')
                ->whereIn('kursus_id', $enrolledCourseIds)
                ->orderByRaw("FIELD(status, 'Sedang Berlangsung','Belum','Sudah') ASC")
                ->orderBy('tanggal', 'asc')
                ->get();
        }

        return view('pages.student.mentoring', compact('mentorings', 'user'));
    }

    /**
     * Teacher: Lihat jadwal mentoring
     */
    public function teacherMentoring()
    {
        $user = Auth::user();

        $mentorings = Mentoring::where('pengajar_id', Auth::id())
            ->with('pengajar', 'kursus.pelajar', 'feedbacks.pelajar')
            ->orderByRaw("FIELD(status, 'Sedang Berlangsung','Belum','Sudah') ASC")
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('pages.teacher.mentoring', compact('mentorings', 'user'));
    }

    /**
     * Admin: Update payment information
     */
    public function updatePayment(Request $request, $courseId, $studentId)
    {
        $request->validate([
            'metode_pembayaran' => 'nullable|string',
            'status_pembayaran' => 'nullable|in:pending,lunas',
            'tanggal_daftar' => 'nullable|date_format:Y-m-d',
        ]);

        $user = User::findOrFail($studentId);
        $course = Kursus::findOrFail($courseId);

        // Update pivot data
        $pivotData = [];

        if ($request->filled('metode_pembayaran')) {
            $pivotData['metode_pembayaran'] = $request->metode_pembayaran;
        }

        if ($request->filled('status_pembayaran')) {
            $pivotData['status_pembayaran'] = $request->status_pembayaran;
        }

        if ($request->filled('tanggal_daftar')) {
            // Convert date to timestamp format for created_at
            $pivotData['created_at'] = $request->tanggal_daftar . ' ' . now()->format('H:i:s');
        }

        if (!empty($pivotData)) {
            $user->enrolledCourses()->updateExistingPivot($courseId, $pivotData);
        }

        return redirect()->back()->with('success', 'Data pembayaran berhasil diperbarui.');
    }
}
