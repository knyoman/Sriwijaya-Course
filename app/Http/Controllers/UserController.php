<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Tampilkan list semua pengguna
    public function index()
    {
        $users = User::all();
        return view('pages.admin.users', compact('users'));
    }

    // Tampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('pages.admin.users-form');
    }

    // Simpan pengguna baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:pengguna|string|max:255',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna',
            'kata_sandi' => 'required|string|min:6',
            'peran' => 'required|in:pelajar,pengajar,admin',
            'alamat' => 'nullable|string',
        ]);

        User::create($validated);

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil ditambahkan');
    }

    // Tampilkan form edit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.users-form', compact('user'));
    }

    // Update data pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:pengguna,username,' . $id . ',id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email,' . $id . ',id',
            'peran' => 'required|in:pelajar,pengajar,admin',
            'alamat' => 'nullable|string',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil diupdate');
    }

    // Hapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus');
    }
}
