<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        // Cek password
        if ($user->isPlainTextPassword()) {
            // Handle plain text password (backward compatibility)
            if ($credentials['password'] !== $user->kata_sandi) {
                return back()->withErrors([
                    'password' => 'Password yang Anda masukkan salah',
                ])->onlyInput('email');
            }
            // Auto-hash plain text password untuk security
            $user->update(['kata_sandi' => Hash::make($credentials['password'])]);
        } else {
            // Handle Bcrypt hashed password (normal)
            if (!Hash::check($credentials['password'], $user->kata_sandi)) {
                return back()->withErrors([
                    'password' => 'Password yang Anda masukkan salah',
                ])->onlyInput('email');
            }
        }

        // Login user
        Auth::login($user, $request->boolean('remember'));

        // Catat aktivitas login
        ActivityLog::create([
            'user_id' => $user->id,
            'activity_type' => 'login',
            'description' => $user->nama . ' melakukan login',
            'action_model' => 'User',
            'model_id' => $user->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

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
        $user = Auth::user();

        // Catat aktivitas logout
        if ($user) {
            ActivityLog::create([
                'user_id' => $user->id,
                'activity_type' => 'logout',
                'description' => $user->nama . ' melakukan logout',
                'action_model' => 'User',
                'model_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah logout');
    }
}
