<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Mentoring;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Dashboard pengajar
     */
    public function dashboard()
    {
        $userId = auth()->id();

        // Jumlah kursus yang diajar pengajar
        $kursusCount = Kursus::where('pengajar_id', $userId)->count();

        // Total pelajar: jumlah semua pelajar di kursus yang dimiliki pengajar
        $courses = Kursus::where('pengajar_id', $userId)->withCount('pelajar')->get();
        $totalPelajar = $courses->sum('pelajar_count');

        // Jumlah sesi mentoring yang akan datang untuk pengajar
        $mentoringUpcoming = Mentoring::where('pengajar_id', $userId)
            ->whereDate('tanggal', '>=', Carbon::now()->toDateString())
            ->count();

        return view('pages.teacher.dashboard', compact('kursusCount', 'totalPelajar', 'mentoringUpcoming'));
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
        $userId = auth()->id();

        // Jumlah kursus yang dibuat pengajar
        $kursusAktifCount = Kursus::where('pengajar_id', $userId)->count();

        // Total peserta: jumlah semua pelajar di kursus yang dimiliki pengajar
        $courses = Kursus::where('pengajar_id', $userId)->withCount('pelajar')->get();
        $totalPeserta = $courses->sum('pelajar_count');

        // Rating dan pendapatan tidak tersedia di schema saat ini
        // Kita tampilkan null/placeholder jika tidak ada data
        $rating = null;
        $pendapatan = null;

        return view('pages.teacher.profile', compact('kursusAktifCount', 'totalPeserta', 'rating', 'pendapatan'));
    }

    /**
     * Update profil pengajar
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:pengguna,email,' . auth()->id()],
            'alamat' => ['nullable', 'string', 'max:500'],
            'nomor_telepon' => ['nullable', 'string', 'max:20'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'in:laki-laki,perempuan'],
            'keahlian' => ['nullable', 'string', 'max:500'],
            'sertifikasi' => ['nullable', 'string', 'max:500'],
            'biografi' => ['nullable', 'string', 'max:1000'],
        ]);

        auth()->user()->update($validated);

        return redirect()->route('teacher.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update password pengajar
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'password_lama' => ['required', 'current_password'],
            'password_baru' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update([
            'kata_sandi' => Hash::make($validated['password_baru']),
        ]);

        return redirect()->route('teacher.profile')->with('success', 'Password berhasil diubah!');
    }
}
