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
        Route::post('/post', 'storePost')->name('store.post');
    });

    Route::controller(AssignmentController::class)->group(function() {
        Route::get('/create-assignment/{course_id}', 'createAssignment')->name('assignment.create.page');
        Route::post('/store-create-assignment', 'storeCreateAssignment')->name('store.create.assignment');
    });

    Route::controller(QuizController::class)->group(function() {
        Route::get('/create-quiz/{course_id}', 'createQuiz')->name('quiz.create.page');
        // Route::post('/store-create-assignment', 'storeCreateAssignment')->name('store.create.assignment');

        Route::get('/quiz/add-question', 'addQuestion');
        Route::get('/quiz/add-option', 'addOption');
        
        Route::get('/remove-question', 'removeQuestion');
        Route::get('/remove-option', 'removeOption');

    });
});


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');