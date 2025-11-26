<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created($model): void
    {
        if (Auth::check()) {
            ActivityLog::record(
                'create',
                'Membuat pengguna baru: ' . ($model->nama ?? $model->username ?? 'Unknown'),
                class_basename($model),
                $model->id
            );
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated($model): void
    {
        if (Auth::check()) {
            ActivityLog::record(
                'update',
                'Mengubah data pengguna: ' . ($model->nama ?? $model->username ?? 'Unknown'),
                class_basename($model),
                $model->id
            );
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted($model): void
    {
        if (Auth::check()) {
            ActivityLog::record(
                'delete',
                'Menghapus pengguna: ' . ($model->nama ?? $model->username ?? 'Unknown'),
                class_basename($model),
                $model->id
            );
        }
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored($model): void
    {
        if (Auth::check()) {
            ActivityLog::record(
                'restore',
                'Mengembalikan pengguna: ' . ($model->nama ?? $model->username ?? 'Unknown'),
                class_basename($model),
                $model->id
            );
        }
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted($model): void
    {
        if (Auth::check()) {
            ActivityLog::record(
                'force_delete',
                'Menghapus permanen pengguna: ' . ($model->nama ?? $model->username ?? 'Unknown'),
                class_basename($model),
                $model->id
            );
        }
    }
}
