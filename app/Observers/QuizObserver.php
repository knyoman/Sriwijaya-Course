<?php

namespace App\Observers;

use App\Models\Quiz;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class QuizObserver
{
    /**
     * Handle the Quiz "created" event.
     */
    public function created(Quiz $quiz): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'create',
                'description' => "Membuat quiz: {$quiz->nama_quiz}",
                'action_model' => 'Quiz',
                'model_id' => $quiz->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Quiz "updated" event.
     */
    public function updated(Quiz $quiz): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'update',
                'description' => "Mengupdate quiz: {$quiz->nama_quiz}",
                'action_model' => 'Quiz',
                'model_id' => $quiz->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }

    /**
     * Handle the Quiz "deleted" event.
     */
    public function deleted(Quiz $quiz): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'delete',
                'description' => "Menghapus quiz: {$quiz->nama_quiz}",
                'action_model' => 'Quiz',
                'model_id' => $quiz->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }
}
