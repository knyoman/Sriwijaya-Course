<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan dalam sistem',
            ])->onlyInput('email');
        }

        // Cek password menggunakan hash
        if (!\Hash::check($credentials['password'], $user->kata_sandi)) {
            return back()->withErrors([
                'password' => 'Password yang Anda masukkan salah',
            ])->onlyInput('email');
        }

        // Login user
        Auth::login($user, $request->boolean('remember'));

        // Redirect berdasarkan peran
        return $this->redirectByRole($user);
    }

    /**
     * Redirect user based on their role
     */
    protected function redirectByRole($user)
    {
        switch ($user->peran) {
            case 'pelajar':
                return redirect()->route('pelajar.dashboard')->with('success', 'Selamat datang, Pelajar!');
            case 'pengajar':
                return redirect()->route('pengajar.dashboard')->with('success', 'Selamat datang, Pengajar!');
            case 'admin':
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
            default:
                return redirect()->route('home');
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah logout');
    }
}
