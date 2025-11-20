<?php

namespace App\Http\Controllers;

use App\Models\Diskusi;
use App\Models\BalasDiskusi;
use App\Models\Kursus;
use Illuminate\Http\Request;

class DiskusiController extends Controller
{
    /**
     * Tampilkan daftar diskusi untuk kursus
     */
    public function index($courseId)
    {
        $course = Kursus::findOrFail($courseId);
        $diskusiList = $course->diskusi()->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.teacher.courses-diskusi', compact('course', 'diskusiList'));
    }

    /**
     * Tampilkan detail diskusi dengan balasan
     */
    public function show($courseId, $diskusiId)
    {
        $course = Kursus::findOrFail($courseId);
        $diskusi = Diskusi::with('pembuat', 'balasan.pembuat')->findOrFail($diskusiId);

        // Verifikasi bahwa diskusi milik kursus ini
        if ($diskusi->kursus_id !== $course->id) {
            abort(404);
        }

        $balasan = $diskusi->balasan;
        $peserta_list = BalasDiskusi::where('diskusi_id', $diskusiId)
            ->distinct('pembuat_id')
            ->with('pembuat')
            ->get();
        $peserta_aktif = $peserta_list->count() + 1; // +1 untuk pembuat diskusi

        return view('pages.teacher.courses-diskusi-detail', compact('course', 'diskusi', 'balasan', 'peserta_aktif', 'peserta_list'));
    }

    /**
     * Buat diskusi baru
     */
    public function store(Request $request, $courseId)
    {
        $course = Kursus::findOrFail($courseId);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        $validated['kursus_id'] = $courseId;
        $validated['pembuat_id'] = auth()->id();
        $validated['jumlah_balasan'] = 0;

        Diskusi::create($validated);

        return redirect()->route('teacher.courses.diskusi.index', $courseId)
            ->with('success', 'Diskusi berhasil dibuat');
    }

    /**
     * Hapus diskusi
     */
    public function destroy($courseId, $diskusiId)
    {
        $course = Kursus::findOrFail($courseId);
        $diskusi = Diskusi::findOrFail($diskusiId);

        // Verifikasi kepemilikan dan akses
        if ($diskusi->kursus_id !== $course->id || $diskusi->pembuat_id !== auth()->id()) {
            abort(403);
        }

        $diskusi->delete();

        return redirect()->route('teacher.courses.diskusi.index', $courseId)
            ->with('success', 'Diskusi berhasil dihapus');
    }

    /**
     * Tambah balasan diskusi
     */
    public function storeBalasan(Request $request, $courseId, $diskusiId)
    {
        $course = Kursus::findOrFail($courseId);
        $diskusi = Diskusi::findOrFail($diskusiId);

        // Verifikasi bahwa diskusi milik kursus ini
        if ($diskusi->kursus_id !== $course->id) {
            abort(404);
        }

        $validated = $request->validate([
            'konten' => 'required|string',
        ]);

        $validated['diskusi_id'] = $diskusiId;
        $validated['pembuat_id'] = auth()->id();

        BalasDiskusi::create($validated);

        // Update jumlah balasan
        $diskusi->increment('jumlah_balasan');

        return redirect()->route('teacher.courses.diskusi.show', [$courseId, $diskusiId])
            ->with('success', 'Balasan berhasil ditambahkan');
    }

    /**
     * Hapus balasan diskusi
     */
    public function destroyBalasan($courseId, $diskusiId, $balasDiskusiId)
    {
        $course = Kursus::findOrFail($courseId);
        $diskusi = Diskusi::findOrFail($diskusiId);
        $balasan = BalasDiskusi::findOrFail($balasDiskusiId);

        // Verifikasi
        if ($diskusi->kursus_id !== $course->id || $balasan->pembuat_id !== auth()->id()) {
            abort(403);
        }

        $balasan->delete();
        $diskusi->decrement('jumlah_balasan');

        return redirect()->route('teacher.courses.diskusi.show', [$courseId, $diskusiId])
            ->with('success', 'Balasan berhasil dihapus');
    }

    /**
     * Student: Tampilkan daftar diskusi untuk student
     */
    public function indexStudent($courseId)
    {
        $course = Kursus::findOrFail($courseId);

        // Verify user enrolled
        if (!auth()->user()->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            abort(403, 'Anda belum terdaftar di kursus ini');
        }

        $diskusiList = $course->diskusi()->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.student.courses-diskusi', compact('course', 'diskusiList'));
    }

    /**
     * Student: Tampilkan detail diskusi dengan balasan
     */
    public function showStudent($courseId, $diskusiId)
    {
        $course = Kursus::findOrFail($courseId);

        // Verify user enrolled
        if (!auth()->user()->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            abort(403, 'Anda belum terdaftar di kursus ini');
        }

        $diskusi = Diskusi::with('pembuat', 'balasan.pembuat')->findOrFail($diskusiId);

        // Verifikasi bahwa diskusi milik kursus ini
        if ($diskusi->kursus_id !== $course->id) {
            abort(404);
        }

        $balasan = $diskusi->balasan;
        $peserta_list = BalasDiskusi::where('diskusi_id', $diskusiId)
            ->distinct('pembuat_id')
            ->with('pembuat')
            ->get();
        $peserta_aktif = $peserta_list->count() + 1; // +1 untuk pembuat diskusi

        return view('pages.student.courses-diskusi-detail', compact('course', 'diskusi', 'balasan', 'peserta_aktif', 'peserta_list'));
    }

    /**
     * Student: Tambah balasan diskusi
     */
    public function storeBalasanStudent(Request $request, $courseId, $diskusiId)
    {
        $course = Kursus::findOrFail($courseId);

        // Verify user enrolled
        if (!auth()->user()->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            abort(403, 'Anda belum terdaftar di kursus ini');
        }

        $diskusi = Diskusi::findOrFail($diskusiId);

        // Verifikasi bahwa diskusi milik kursus ini
        if ($diskusi->kursus_id !== $course->id) {
            abort(404);
        }

        $validated = $request->validate([
            'konten' => 'required|string',
        ]);

        $validated['diskusi_id'] = $diskusiId;
        $validated['pembuat_id'] = auth()->id();

        BalasDiskusi::create($validated);

        // Update jumlah balasan
        $diskusi->increment('jumlah_balasan');

        return redirect()->route('student.courses.diskusi.show', [$courseId, $diskusiId])
            ->with('success', 'Balasan berhasil ditambahkan');
    }

    /**
     * Student: Hapus balasan diskusi
     */
    public function destroyBalasanStudent($courseId, $diskusiId, $balasDiskusiId)
    {
        $course = Kursus::findOrFail($courseId);

        // Verify user enrolled
        if (!auth()->user()->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            abort(403, 'Anda belum terdaftar di kursus ini');
        }

        $diskusi = Diskusi::findOrFail($diskusiId);
        $balasan = BalasDiskusi::findOrFail($balasDiskusiId);

        // Verifikasi
        if ($diskusi->kursus_id !== $course->id || $balasan->pembuat_id !== auth()->id()) {
            abort(403);
        }

        $balasan->delete();
        $diskusi->decrement('jumlah_balasan');

        return redirect()->route('student.courses.diskusi.show', [$courseId, $diskusiId])
            ->with('success', 'Balasan berhasil dihapus');
    }

    /**
     * Student: Buat diskusi baru
     */
    public function storeStudent(Request $request, $courseId)
    {
        $course = Kursus::findOrFail($courseId);

        // Verify user enrolled
        if (!auth()->user()->enrolledCourses()->where('kursus_id', $courseId)->exists()) {
            abort(403, 'Anda belum terdaftar di kursus ini');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        $validated['kursus_id'] = $courseId;
        $validated['pembuat_id'] = auth()->id();
        $validated['jumlah_balasan'] = 0;

        Diskusi::create($validated);

        return redirect()->route('student.courses.diskusi.index', $courseId)
            ->with('success', 'Diskusi berhasil dibuat');
    }
}
