<?php

namespace App\Observers;

use App\Models\MentoringFeedback;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class MentoringFeedbackObserver
{
    /**
     * Handle the MentoringFeedback "created" event.
     */
    public function created(MentoringFeedback $feedback): void
    {
        if (Auth::check()) {
            $kursusNama = $feedback->mentoring->kursus->nama ?? 'Kursus';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'create',
                'description' => "Memberikan feedback mentoring untuk {$kursusNama}",
                'action_model' => 'MentoringFeedback',
                'model_id' => $feedback->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the MentoringFeedback "updated" event.
     */
    public function updated(MentoringFeedback $feedback): void
    {
        if (Auth::check()) {
            $kursusNama = $feedback->mentoring->kursus->nama ?? 'Kursus';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'update',
                'description' => "Mengupdate feedback mentoring untuk {$kursusNama}",
                'action_model' => 'MentoringFeedback',
                'model_id' => $feedback->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the MentoringFeedback "deleted" event.
     */
    public function deleted(MentoringFeedback $feedback): void
    {
        if (Auth::check()) {
            $kursusNama = $feedback->mentoring->kursus->nama ?? 'Kursus';
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'delete',
                'description' => "Menghapus feedback mentoring untuk {$kursusNama}",
                'action_model' => 'MentoringFeedback',
                'model_id' => $feedback->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }
}
