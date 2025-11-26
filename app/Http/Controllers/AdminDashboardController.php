<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Kursus;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends BaseController
{
    public function index()
    {
        // Hitung statistik
        $totalUsers = User::count();
        $totalTeachers = User::where('peran', 'pengajar')->count();
        $totalStudents = User::where('peran', 'pelajar')->count();
        $totalCourses = Kursus::count();

        // Ambil activity logs terbaru (5 logs saja untuk dashboard)
        $activityLogs = ActivityLog::with('user')
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalUsers',
            'totalTeachers',
            'totalStudents',
            'totalCourses',
            'activityLogs'
        ));
    }

    public function activityLogs()
    {
        $query = ActivityLog::with('user');

        // Filter berdasarkan pencarian pengguna
        if (request('search_user')) {
            $searchTerm = request('search_user');
            $query->whereHas('user', function ($q) use ($searchTerm) {
                $q->where('nama', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('username', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filter berdasarkan tipe aktivitas
        if (request('activity_type')) {
            $query->where('activity_type', request('activity_type'));
        }

        // Filter berdasarkan tanggal
        if (request('date_from')) {
            $query->whereDate('created_at', '>=', request('date_from'));
        }

        if (request('date_to')) {
            $query->whereDate('created_at', '<=', request('date_to'));
        }

        $activityLogs = $query->latest('created_at')->paginate(20);

        return view('pages.admin.activity-logs', compact('activityLogs'));
    }
}
