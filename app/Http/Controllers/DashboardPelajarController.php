<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPelajarController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get total enrolled courses
        $totalKursusAktif = $user->enrolledCourses()->count();

        // Get total certificates
        $totalSertifikat = $user->certificates()->count();

        // Get completed courses (courses with certificates)
        $kelasSelesai = $user->certificates()->distinct('kursus_id')->count('kursus_id');

        // Get enrolled courses with material progress
        $kursusAktif = $user->enrolledCourses()
            ->with('materi', 'quiz')
            ->get();

        return view('dashboard.pelajar', [
            'totalKursusAktif' => $totalKursusAktif,
            'totalSertifikat' => $totalSertifikat,
            'kelasSelesai' => $kelasSelesai,
            'kursusAktif' => $kursusAktif,
        ]);
    }
}
