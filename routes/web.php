<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ExtracurricularController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/students', [StudentController::class, 'index'])->middleware('auth');

Route::middleware(['auth', 'must-admin-or-teacher'])->group(function () {
    Route::get('/student/{slug}', [StudentController::class, 'show']);
    Route::get('/student-add', [StudentController::class, 'create']);
    Route::post('/student', [StudentController::class, 'store']);
    Route::get('/student-edit/{slug}', [StudentController::class, 'edit']);
    Route::put('/student/{id}', [StudentController::class, 'update']);
});

// Route::post('/student-delete/{id}', [StudentController::class, 'delete'])->middleware(['auth', 'must-admin']);
Route::middleware(['auth', 'must-admin'])->group(function () {
    Route::post('/student-delete/{slug}', [StudentController::class, 'delete']);
    Route::delete('/student-destroy/{id}', [StudentController::class, 'destroy']);
    Route::get('/student-deleted', [StudentController::class, 'deletedStudent']);
    Route::get('/student/{slug}/restore', [StudentController::class, 'restore']);
});

Route::post('/ekskul-add', [StudentController::class, 'addEkskul'])->middleware('auth');
Route::post('/ekskul-edit', [StudentController::class, 'editEkskul'])->middleware('auth');

Route::get('/class', [ClassController::class, 'index'])->middleware('auth');
Route::get('/class/{id}', [ClassController::class, 'show'])->middleware('auth');

Route::get('/extracurricular', [ExtracurricularController::class, 'index'])->middleware('auth');
Route::get('/extracurricular/{id}', [ExtracurricularController::class, 'show'])->middleware('auth');

Route::get('/teacher', [TeacherController::class, 'index'])->middleware('auth');
Route::get('/teacher/{id}', [TeacherController::class, 'show'])->middleware('auth');

// Route::get('/student-mass-update', [StudentController::class, 'massUpdate']);
