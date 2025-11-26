<?php

namespace App\Observers;

use App\Models\Diskusi;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class DiskusiObserver
{
    /**
     * Handle the Diskusi "created" event.
     */
    public function created(Diskusi $diskusi): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'create',
                'description' => "Membuat diskusi: {$diskusi->judul}",
                'action_model' => 'Diskusi',
                'model_id' => $diskusi->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Diskusi "updated" event.
     */
    public function updated(Diskusi $diskusi): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'update',
                'description' => "Mengupdate diskusi: {$diskusi->judul}",
                'action_model' => 'Diskusi',
                'model_id' => $diskusi->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Diskusi "deleted" event.
     */
    public function deleted(Diskusi $diskusi): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'delete',
                'description' => "Menghapus diskusi: {$diskusi->judul}",
                'action_model' => 'Diskusi',
                'model_id' => $diskusi->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }
}
