<?php

namespace App\Http\Controllers;

use App\Models\Mentoring;
use App\Models\MentoringFeedback;
use App\Models\User;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentoringController extends Controller
{
    /**
     * Admin: Tampilkan daftar mentoring
     */
    public function index()
    {
        $mentorings = Mentoring::with('pengajar', 'kursus.pelajar')->orderBy('tanggal', 'asc')->get();
        return view('pages.admin.mentoring', compact('mentorings'));
    }

    /**
     * Admin: Tampilkan form create mentoring
     */
    public function create()
    {
        $pengajars = User::where('peran', 'pengajar')->get();
        $kursuses = Kursus::all();
        return view('pages.admin.mentoring-form', compact('pengajars', 'kursuses'));
    }

    /**
     * Admin: Simpan mentoring baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengajar_id' => 'required|exists:pengguna,id',
            'kursus_id' => 'required|exists:kursus,id',
            'tanggal' => 'required|date|after:today',
            'jam' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:15|max:480',
            'topik' => 'required|string|max:255',
            'status' => 'required|in:Belum,Sedang Berlangsung,Sudah',
            'zoom_link' => 'nullable|url',
        ]);

        Mentoring::create($validated);

        return redirect()->route('admin.mentoring')->with('success', 'Jadwal mentoring berhasil ditambahkan');
    }

    /**
     * Admin: Tampilkan form edit mentoring
     */
    public function edit($id)
    {
        $mentoring = Mentoring::findOrFail($id);
        $pengajars = User::where('peran', 'pengajar')->get();
        $kursuses = Kursus::all();
        return view('pages.admin.mentoring-form', compact('mentoring', 'pengajars', 'kursuses'));
    }

    /**
     * Admin: Update mentoring
     */
    public function update(Request $request, $id)
    {
        $mentoring = Mentoring::findOrFail($id);

        $validated = $request->validate([
            'pengajar_id' => 'required|exists:pengguna,id',
            'kursus_id' => 'required|exists:kursus,id',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:15|max:480',
            'topik' => 'required|string|max:255',
            'status' => 'required|in:Belum,Sedang Berlangsung,Sudah',
            'zoom_link' => 'nullable|url',
        ]);

        $mentoring->update($validated);

        return redirect()->route('admin.mentoring')->with('success', 'Jadwal mentoring berhasil diupdate');
    }

    /**
     * Admin: Hapus mentoring
     */
    public function destroy($id)
    {
        $mentoring = Mentoring::findOrFail($id);
        $mentoring->delete();

        return redirect()->route('admin.mentoring')->with('success', 'Jadwal mentoring berhasil dihapus');
    }

    /**
     * Student: Simpan feedback mentoring
     */
    public function storeFeedback(Request $request, $mentoringId)
    {
        $mentoring = Mentoring::findOrFail($mentoringId);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback_text' => 'required|string|min:10|max:1000',
            'benefits' => 'nullable|array',
        ]);

        $validated['mentoring_id'] = $mentoringId;
        $validated['pelajar_id'] = Auth::id();

        // Handle benefits array - jika kosong, set ke null atau empty array
        if (empty($validated['benefits'])) {
            $validated['benefits'] = null;
        }

        // Update atau create feedback
        MentoringFeedback::updateOrCreate(
            [
                'mentoring_id' => $mentoringId,
                'pelajar_id' => Auth::id(),
            ],
            $validated
        );

        return redirect()->back()->with('success', 'Terima kasih atas feedback Anda!');
    }

    /**
     * Admin: Lihat feedback dari pelajar untuk mentoring tertentu
     */
    public function showFeedback($mentoringId)
    {
        $mentoring = Mentoring::with('pengajar', 'kursus', 'feedbacks.pelajar')->findOrFail($mentoringId);
        $feedbacks = $mentoring->feedbacks;

        return view('pages.admin.mentoring-feedback', compact('mentoring', 'feedbacks'));
    }
}
