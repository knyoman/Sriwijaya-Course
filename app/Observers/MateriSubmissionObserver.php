<?php

namespace App\Observers;

use App\Models\MateriSubmission;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class MateriSubmissionObserver
{
    /**
     * Handle the MateriSubmission "created" event.
     */
    public function created(MateriSubmission $submission): void
    {
        if (Auth::check()) {
            $materiTitle = $submission->materi->judul_materi ?? 'Materi';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'submit',
                'description' => "Mengumpulkan tugas: {$materiTitle}",
                'action_model' => 'MateriSubmission',
                'model_id' => $submission->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the MateriSubmission "updated" event.
     */
    public function updated(MateriSubmission $submission): void
    {
        if (Auth::check()) {
            $materiTitle = $submission->materi->judul_materi ?? 'Materi';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'update',
                'description' => "Mengupdate pengumpulan tugas: {$materiTitle}",
                'action_model' => 'MateriSubmission',
                'model_id' => $submission->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the MateriSubmission "deleted" event.
     */
    public function deleted(MateriSubmission $submission): void
    {
        if (Auth::check()) {
            $materiTitle = $submission->materi->judul_materi ?? 'Materi';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'delete',
                'description' => "Membatalkan pengumpulan tugas: {$materiTitle}",
                'action_model' => 'MateriSubmission',
                'model_id' => $submission->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }
}
