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
        Route::get('/dashboard/pelajar', function () {
            return view('dashboard.pelajar');
        })->name('pelajar.dashboard');

        // Student Pages
        Route::get('/student/courses', [CourseController::class, 'studentCourses'])->name('student.courses');
        Route::post('/student/courses/{id}/enroll', [CourseController::class, 'studentEnroll'])->name('student.course.enroll');
        Route::get('/student/my-courses', function () {
            return view('pages.student.my-courses');
        })->name('student.my-courses');
        Route::get('/student/certificates', function () {
            return view('pages.student.certificates');
        })->name('student.certificates');
        Route::get('/student/mentoring', function () {
            return view('pages.student.mentoring');
        })->name('student.mentoring');
        Route::get('/student/payments', function () {
            return view('pages.student.payments');
        })->name('student.payments');
        Route::get('/student/profile', function () {
            return view('pages.student.profile');
        })->name('student.profile');
        Route::get('/student/course/{id}/learn', [CourseController::class, 'studentCourseLearn'])->name('student.course-learn');
        Route::get('/student/quiz', function () {
            return view('pages.student.quiz');
        })->name('student.quiz');
        Route::get('/student/quiz-result', function () {
            return view('pages.student.quiz-result');
        })->name('student.quiz-result');
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
        Route::get('/teacher/mentoring', [TeacherController::class, 'mentoring'])->name('teacher.mentoring');
        Route::get('/teacher/profile', [TeacherController::class, 'profile'])->name('teacher.profile');
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

        // Diskusi Routes (placeholder - akan ditambahkan controller nanti)
        Route::get('/teacher/courses/{courseId}/diskusi', function ($courseId) {
            return view('pages.teacher.courses-diskusi');
        })->name('teacher.courses.diskusi.index');
    });

    // Admin Dashboard
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard/admin', function () {
            return view('dashboard.admin');
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

        Route::get('/admin/payments', function () {
            return view('pages.admin.payments');
        })->name('admin.payments');

        // Mentoring Management
        Route::get('/admin/mentoring', function () {
            return view('pages.admin.mentoring');
        })->name('admin.mentoring');
        Route::get('/admin/mentoring/create', function () {
            return view('pages.admin.mentoring-form');
        })->name('admin.mentoring.create');
        Route::post('/admin/mentoring/store', function () {
            return redirect()->route('admin.mentoring')->with('success', 'Jadwal mentoring berhasil ditambahkan');
        })->name('admin.mentoring.store');
        Route::get('/admin/mentoring/{id}/edit', function ($id) {
            $mentoring = [
                'id' => $id,
                'pengajar' => 'Nama Pengajar',
                'tanggal' => '2025-12-01',
                'jam' => '09:00',
                'status' => 'Belum',
                'zoom_link' => 'https://zoom.us/j/1234567890'
            ];
            return view('pages.admin.mentoring-form', compact('mentoring'));
        })->name('admin.mentoring.edit');
        Route::post('/admin/mentoring/{id}/update', function ($id) {
            return redirect()->route('admin.mentoring')->with('success', 'Jadwal mentoring berhasil diupdate');
        })->name('admin.mentoring.update');
        Route::get('/admin/mentoring/{id}/delete', function ($id) {
            return redirect()->route('admin.mentoring')->with('success', 'Jadwal mentoring berhasil dihapus');
        })->name('admin.mentoring.delete');

        Route::get('/admin/certificates', function () {
            return view('pages.admin.certificates');
        })->name('admin.certificates');
    });
});

Route::get('/courses/{slug}', [CourseDetailController::class, 'show'])->name('course.detail');
