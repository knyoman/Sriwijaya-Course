<?php

namespace App\Http\Controllers;

use App\Models\Mentoring;
use App\Models\User;
use Illuminate\Http\Request;

class MentoringController extends Controller
{
    /**
     * Admin: Tampilkan daftar mentoring
     */
    public function index()
    {
        $mentorings = Mentoring::with('pengajar')->orderBy('tanggal', 'asc')->get();
        return view('pages.admin.mentoring', compact('mentorings'));
    }

    /**
     * Admin: Tampilkan form create mentoring
     */
    public function create()
    {
        $pengajars = User::where('peran', 'pengajar')->get();
        return view('pages.admin.mentoring-form', compact('pengajars'));
    }

    /**
     * Admin: Simpan mentoring baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengajar_id' => 'required|exists:pengguna,id',
            'tanggal' => 'required|date|after:today',
            'jam' => 'required|date_format:H:i',
            'status' => 'required|in:Belum,Sudah',
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
        return view('pages.admin.mentoring-form', compact('mentoring', 'pengajars'));
    }

    /**
     * Admin: Update mentoring
     */
    public function update(Request $request, $id)
    {
        $mentoring = Mentoring::findOrFail($id);

        $validated = $request->validate([
            'pengajar_id' => 'required|exists:pengguna,id',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'status' => 'required|in:Belum,Sudah',
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
}
