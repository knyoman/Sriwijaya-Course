<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Materi;
use App\Models\Kursus;
use App\Models\Quiz;
use App\Models\MateriSubmission;
use App\Models\Diskusi;
use App\Models\BalasDiskusi;
use App\Models\Mentoring;
use App\Models\MentoringFeedback;
use App\Observers\UserObserver;
use App\Observers\ActivityObserver;
use App\Observers\MateriObserver;
use App\Observers\KursusObserver;
use App\Observers\QuizObserver;
use App\Observers\MateriSubmissionObserver;
use App\Observers\DiskusiObserver;
use App\Observers\BalasDiskusiObserver;
use App\Observers\MentoringObserver;
use App\Observers\MentoringFeedbackObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register UserObserver untuk auto-hash password
        User::observe(UserObserver::class);
        // Register ActivityObserver untuk mencatat aktivitas user
        User::observe(ActivityObserver::class);

        // Register Materi, Kursus, dan Quiz Observers untuk mencatat aktivitas pengajar
        Materi::observe(MateriObserver::class);
        Kursus::observe(KursusObserver::class);
        Quiz::observe(QuizObserver::class);

        // Register Observers untuk mencatat aktivitas pelajar
        MateriSubmission::observe(MateriSubmissionObserver::class);
        Diskusi::observe(DiskusiObserver::class);
        BalasDiskusi::observe(BalasDiskusiObserver::class);

        // Register Observers untuk mencatat aktivitas mentoring
        Mentoring::observe(MentoringObserver::class);
        MentoringFeedback::observe(MentoringFeedbackObserver::class);
    }
}
