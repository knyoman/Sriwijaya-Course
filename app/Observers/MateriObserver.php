<?php

namespace App\Observers;

use App\Models\Materi;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class MateriObserver
{
    /**
     * Handle the Materi "created" event.
     */
    public function created(Materi $materi): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'create',
                'description' => "Menambahkan materi: {$materi->judul_materi}",
                'action_model' => 'Materi',
                'model_id' => $materi->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Materi "updated" event.
     */
    public function updated(Materi $materi): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'update',
                'description' => "Mengupdate materi: {$materi->judul_materi}",
                'action_model' => 'Materi',
                'model_id' => $materi->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Materi "deleted" event.
     */
    public function deleted(Materi $materi): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'delete',
                'description' => "Menghapus materi: {$materi->judul_materi}",
                'action_model' => 'Materi',
                'model_id' => $materi->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Materi "restored" event.
     */
    public function restored(Materi $materi): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'restore',
                'description' => "Mengembalikan materi: {$materi->judul_materi}",
                'action_model' => 'Materi',
                'model_id' => $materi->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Materi "force deleted" event.
     */
    public function forceDeleted(Materi $materi): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'force_delete',
                'description' => "Menghapus permanen materi: {$materi->judul_materi}",
                'action_model' => 'Materi',
                'model_id' => $materi->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }
}
