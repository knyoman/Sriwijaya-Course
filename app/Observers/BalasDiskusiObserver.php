<?php

namespace App\Observers;

use App\Models\BalasDiskusi;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class BalasDiskusiObserver
{
    /**
     * Handle the BalasDiskusi "created" event.
     */
    public function created(BalasDiskusi $balasan): void
    {
        if (Auth::check()) {
            $judulDiskusi = $balasan->diskusi->judul ?? 'Diskusi';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'reply',
                'description' => "Membalas diskusi: {$judulDiskusi}",
                'action_model' => 'BalasDiskusi',
                'model_id' => $balasan->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the BalasDiskusi "updated" event.
     */
    public function updated(BalasDiskusi $balasan): void
    {
        if (Auth::check()) {
            $judulDiskusi = $balasan->diskusi->judul ?? 'Diskusi';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'update',
                'description' => "Mengupdate balasan diskusi: {$judulDiskusi}",
                'action_model' => 'BalasDiskusi',
                'model_id' => $balasan->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the BalasDiskusi "deleted" event.
     */
    public function deleted(BalasDiskusi $balasan): void
    {
        if (Auth::check()) {
            $judulDiskusi = $balasan->diskusi->judul ?? 'Diskusi';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'delete',
                'description' => "Menghapus balasan diskusi: {$judulDiskusi}",
                'action_model' => 'BalasDiskusi',
                'model_id' => $balasan->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }
}
