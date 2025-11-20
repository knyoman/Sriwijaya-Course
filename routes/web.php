<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SoalQuizController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\MentoringController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardPelajarController;
use App\Models\User;
use App\Models\Kursus;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/courses', [PageController::class, 'courses'])->name('courses');
Route::get('/about', [PageController::class, 'about'])->name('about');

// Guest Routes (hanya untuk yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

// Authenticated Routes (hanya untuk yang sudah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Pelajar Dashboard
    Route::middleware('role:pelajar')->group(function () {
        Route::get('/dashboard/pelajar', [DashboardPelajarController::class, 'index'])->name('pelajar.dashboard');

        // Student Pages
        Route::get('/student/courses', [CourseController::class, 'studentCourses'])->name('student.courses');
        Route::get('/student/my-courses', [CourseController::class, 'studentMyCourses'])->name('student.my-courses');
        Route::post('/student/courses/{id}/enroll', [CourseController::class, 'studentEnroll'])->name('student.course.enroll');
        Route::get('/student/certificates', [CertificateController::class, 'index'])->name('student.certificates');
        Route::get('/student/mentoring', [CourseController::class, 'studentMentoring'])->name('student.mentoring');
        Route::post('/student/mentoring/{mentoringId}/feedback', [MentoringController::class, 'storeFeedback'])->name('student.mentoring.feedback');
        Route::get('/student/payments', [CourseController::class, 'studentPayments'])->name('student.payments');
        Route::get('/student/profile', [ProfileController::class, 'show'])->name('student.profile');
        Route::put('/student/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/student/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
        Route::get('/student/course/{id}/learn', [CourseController::class, 'studentCourseLearn'])->name('student.course-learn');
        Route::get('/student/courses/{courseId}/diskusi', [DiskusiController::class, 'indexStudent'])->name('student.courses.diskusi.index');
        Route::post('/student/courses/{courseId}/diskusi', [DiskusiController::class, 'storeStudent'])->name('student.courses.diskusi.store');
        Route::get('/student/courses/{courseId}/diskusi/{diskusiId}', [DiskusiController::class, 'showStudent'])->name('student.courses.diskusi.show');
        Route::post('/student/courses/{courseId}/diskusi/{diskusiId}/balasan', [DiskusiController::class, 'storeBalasanStudent'])->name('student.courses.diskusi.balasan.store');
        Route::delete('/student/courses/{courseId}/diskusi/{diskusiId}/balasan/{balasDiskusiId}', [DiskusiController::class, 'destroyBalasanStudent'])->name('student.courses.diskusi.balasan.destroy');
        Route::get('/student/courses/{courseId}/quiz/{quizId}', [QuizController::class, 'show'])->name('student.quiz.show');
        Route::post('/student/courses/{courseId}/quiz/{quizId}/submit', [QuizController::class, 'submit'])->name('student.quiz.submit');
        Route::get('/student/quiz', function () {
            return view('pages.student.quiz');
        })->name('student.quiz');
        Route::get('/student/quiz-result', function () {
            return view('pages.student.quiz-result');
        })->name('student.quiz-result');
        Route::post('/student/courses/{courseId}/quiz/{quizId}/certificate', [CertificateController::class, 'store'])->name('student.certificate.store');
        Route::get('/student/certificate/{certificateId}', [CertificateController::class, 'show'])->name('student.certificate.show');
        Route::get('/student/certificate/{certificateId}/download', [CertificateController::class, 'download'])->name('student.certificate.download');
        Route::get('/student/certificates-list', [CertificateController::class, 'index'])->name('student.certificate.index');
        Route::get('/student/certificate', function () {
            return view('pages.student.certificate');
        })->name('student.certificate');
    });

    // Pengajar Dashboard
    Route::middleware('role:pengajar')->group(function () {
        Route::get('/dashboard/pengajar', [TeacherController::class, 'dashboard'])->name('pengajar.dashboard');
        Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
        Route::get('/teacher/courses', [CourseController::class, 'teacherCourses'])->name('teacher.courses');
        Route::get('/teacher/courses/{id}/materials', [TeacherController::class, 'courseMaterials'])->name('teacher.course-materials');
        Route::get('/teacher/mentoring', [CourseController::class, 'teacherMentoring'])->name('teacher.mentoring');
        Route::get('/teacher/profile', [TeacherController::class, 'profile'])->name('teacher.profile');
        Route::put('/teacher/profile', [TeacherController::class, 'updateProfile'])->name('teacher.profile.update');
        Route::put('/teacher/profile/password', [TeacherController::class, 'updatePassword'])->name('teacher.profile.update-password');
        Route::get('/teacher/certificates', [TeacherController::class, 'courses'])->name('teacher.certificates');

        // Materi Routes
        Route::post('/teacher/courses/{courseId}/materi/store', [MateriController::class, 'store'])->name('materi.store');
        Route::put('/teacher/materi/{materiId}', [MateriController::class, 'update'])->name('materi.update');
        Route::delete('/teacher/materi/{materiId}', [MateriController::class, 'destroy'])->name('materi.destroy');

        // Quiz Routes
        Route::post('/teacher/courses/{courseId}/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
        Route::put('/teacher/quiz/{quizId}', [QuizController::class, 'update'])->name('quiz.update');
        Route::delete('/teacher/quiz/{quizId}', [QuizController::class, 'destroy'])->name('quiz.destroy');

        // Soal Quiz Routes
        Route::get('/teacher/quiz/{quizId}/soal', [SoalQuizController::class, 'edit'])->name('soal-quiz.edit');
        Route::post('/teacher/courses/{courseId}/quiz/{quizId}/soal/store', [SoalQuizController::class, 'store'])->name('soal-quiz.store');
        Route::put('/teacher/soal-quiz/{soalId}', [SoalQuizController::class, 'update'])->name('soal-quiz.update');
        Route::delete('/teacher/soal-quiz/{soalId}', [SoalQuizController::class, 'destroy'])->name('soal-quiz.destroy');

        // Diskusi Routes
        Route::get('/teacher/courses/{courseId}/diskusi', [DiskusiController::class, 'index'])->name('teacher.courses.diskusi.index');
        Route::get('/teacher/courses/{courseId}/diskusi/{diskusiId}', [DiskusiController::class, 'show'])->name('teacher.courses.diskusi.show');
        Route::post('/teacher/courses/{courseId}/diskusi', [DiskusiController::class, 'store'])->name('teacher.courses.diskusi.store');
        Route::delete('/teacher/courses/{courseId}/diskusi/{diskusiId}', [DiskusiController::class, 'destroy'])->name('teacher.courses.diskusi.destroy');
        Route::post('/teacher/courses/{courseId}/diskusi/{diskusiId}/balasan', [DiskusiController::class, 'storeBalasan'])->name('teacher.courses.diskusi.balasan.store');
        Route::delete('/teacher/courses/{courseId}/diskusi/{diskusiId}/balasan/{balasDiskusiId}', [DiskusiController::class, 'destroyBalasan'])->name('teacher.courses.diskusi.balasan.destroy');
    });

    // Admin Dashboard
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard/admin', function () {
            // Ambil statistik dari database sehingga view tidak bergantung pada nilai hardcoded
            $totalUsers = User::count();
            $totalKursus = Kursus::count();
            $pengajarCount = User::where('peran', 'pengajar')->count();
            $pelajarCount = User::where('peran', 'pelajar')->count();

            return view('dashboard.admin', compact('totalUsers', 'totalKursus', 'pengajarCount', 'pelajarCount'));
        })->name('admin.dashboard');

        // Users Management
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::post('/admin/users/{id}/update', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

        // Courses Management
        Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses');
        Route::get('/admin/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
        Route::post('/admin/courses/store', [CourseController::class, 'store'])->name('admin.courses.store');
        Route::get('/admin/courses/{id}/detail', [CourseController::class, 'show'])->name('admin.courses.detail');
        Route::get('/admin/courses/{id}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
        Route::post('/admin/courses/{id}/update', [CourseController::class, 'update'])->name('admin.courses.update');
        Route::delete('/admin/courses/{id}', [CourseController::class, 'destroy'])->name('admin.courses.delete');

        Route::get('/admin/payments', [CourseController::class, 'adminPayments'])->name('admin.payments');

        // Mentoring Management
        Route::get('/admin/mentoring', [MentoringController::class, 'index'])->name('admin.mentoring');
        Route::get('/admin/mentoring/create', [MentoringController::class, 'create'])->name('admin.mentoring.create');
        Route::post('/admin/mentoring/store', [MentoringController::class, 'store'])->name('admin.mentoring.store');
        Route::get('/admin/mentoring/{id}/edit', [MentoringController::class, 'edit'])->name('admin.mentoring.edit');
        Route::post('/admin/mentoring/{id}/update', [MentoringController::class, 'update'])->name('admin.mentoring.update');
        Route::delete('/admin/mentoring/{id}', [MentoringController::class, 'destroy'])->name('admin.mentoring.destroy');
        Route::get('/admin/mentoring/{mentoringId}/feedback', [MentoringController::class, 'showFeedback'])->name('admin.mentoring.feedback');

        Route::get('/admin/certificates', function () {
            return view('pages.admin.certificates');
        })->name('admin.certificates');
    });
});

Route::get('/courses/{slug}', [CourseDetailController::class, 'show'])->name('course.detail');
