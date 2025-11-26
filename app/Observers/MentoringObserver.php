<?php

namespace App\Observers;

use App\Models\Mentoring;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class MentoringObserver
{
    /**
     * Handle the Mentoring "created" event.
     */
    public function created(Mentoring $mentoring): void
    {
        if (Auth::check()) {
            $kursusNama = $mentoring->kursus->nama ?? 'Kursus';
            $tanggal = $mentoring->tanggal ? $mentoring->tanggal->format('d/m/Y') : '';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'create',
                'description' => "Membuat mentoring untuk {$kursusNama} pada {$tanggal}",
                'action_model' => 'Mentoring',
                'model_id' => $mentoring->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Mentoring "updated" event.
     */
    public function updated(Mentoring $mentoring): void
    {
        if (Auth::check()) {
            $kursusNama = $mentoring->kursus->nama ?? 'Kursus';
            $tanggal = $mentoring->tanggal ? $mentoring->tanggal->format('d/m/Y') : '';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'update',
                'description' => "Mengupdate mentoring untuk {$kursusNama} pada {$tanggal}",
                'action_model' => 'Mentoring',
                'model_id' => $mentoring->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Mentoring "deleted" event.
     */
    public function deleted(Mentoring $mentoring): void
    {
        if (Auth::check()) {
            $kursusNama = $mentoring->kursus->nama ?? 'Kursus';
            $tanggal = $mentoring->tanggal ? $mentoring->tanggal->format('d/m/Y') : '';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'delete',
                'description' => "Menghapus mentoring untuk {$kursusNama} pada {$tanggal}",
                'action_model' => 'Mentoring',
                'model_id' => $mentoring->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }
}
