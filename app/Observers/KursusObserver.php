<?php

namespace App\Observers;

use App\Models\Kursus;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class KursusObserver
{
    /**
     * Handle the Kursus "created" event.
     */
    public function created(Kursus $kursus): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'create',
                'description' => "Membuat kursus: {$kursus->nama}",
                'action_model' => 'Kursus',
                'model_id' => $kursus->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Kursus "updated" event.
     */
    public function updated(Kursus $kursus): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'update',
                'description' => "Mengupdate kursus: {$kursus->nama}",
                'action_model' => 'Kursus',
                'model_id' => $kursus->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Kursus "deleted" event.
     */
    public function deleted(Kursus $kursus): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'delete',
                'description' => "Menghapus kursus: {$kursus->nama}",
                'action_model' => 'Kursus',
                'model_id' => $kursus->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }
}
