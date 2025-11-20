<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('pages.student.profile');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:pengguna,email,' . auth()->id()],
            'alamat' => ['nullable', 'string', 'max:500'],
            'nomor_telepon' => ['nullable', 'string', 'max:20'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'in:laki-laki,perempuan'],
        ]);

        auth()->user()->update($validated);

        return redirect()->route('student.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'password_lama' => ['required', 'current_password'],
            'password_baru' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update([
            'kata_sandi' => Hash::make($validated['password_baru']),
        ]);

        return redirect()->route('student.profile')->with('success', 'Password berhasil diubah!');
    }
}
