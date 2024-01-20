<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function() {
    Route::get('/', [FrontendController::class, 'home'])->name('home');

    Route::controller(CourseController::class)->group(function() {
        Route::get('/courses', 'index')->name('front.courses');
        Route::post('/courses', 'createCourse')->name('create.course');
        Route::get('/course/{id}', 'singleCoursePage')->name('single.course.page');
    });

    Route::controller(PostController::class)->group(function() {
        Route::post('/post', 'storePost')->name('store.normal.post');
        Route::post('/post-like-store', 'postLikeStore')->name('post.like.store');
    });

    Route::controller(AssignmentController::class)->group(function() {
        Route::get('/create-assignment/{course_id}', 'createAssignment')->name('assignment.create.page');
        Route::post('/store-create-assignment', 'storeCreateAssignment')->name('store.create.assignment');

        Route::get('assignment/submit/{id}', 'assignimentSubmitPage')->name('assignment.submit.page');
        Route::post('assignment/submit', 'assignimentSubmitStore')->name('submit.assignment.store');

        Route::get('get-assignment-submission', 'getAssignmentSubmission')->name('get.assignment.submission');
        Route::get('assignment-review-modal', 'assignmentReviewModal')->name('assignment.review.modal');

        Route::post('assignment/review/update', 'assignmentReviewUpdate')->name('assignment.review.update');
        Route::post('teacher/assignment/submission/delete', 'teacherAssignmentSubmissionDelete')->name('teacher.assignment.submission.delete');
    });

    Route::controller(QuizController::class)->group(function() {
        Route::get('/create-quiz/{course_id}', 'createQuiz')->name('quiz.create.page');
        Route::post('/store-quiz', 'storeQuiz')->name('store.quiz.question');

        Route::get('/quiz/add-question', 'addQuestion');
        Route::get('/quiz/add-option', 'addOption');

        Route::get('quiz/submit/{id}', 'quizSubmitPage')->name('quiz.submit.page');
        Route::post('quiz/submit', 'quizSubmitStore')->name('submit.quiz.store');

        Route::get('get-quiz-submission-list', 'getAssignmentSubmission')->name('get.quiz.submission.list');
        Route::get('quiz-review-modal', 'assignmentReviewModal')->name('teacher.quiz.review.modal');

        Route::post('quiz/review/update', 'assignmentReviewUpdate')->name('teacher.quiz.review.update');
        Route::post('teacher/quiz/submission/delete', 'teacherAssignmentSubmissionDelete')->name('teacher.quiz.submission.delete');
    });
});


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');