<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

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
    return view('home', [
        'name' => 'Dimas Tri Raharjo',
        'role' => 'admin',
        'buah' => ['pisang', 'apel', 'jeruk', 'semangka', 'mangga'],
    ]);
});

Route::get('/students', [StudentController::class, 'index']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::get('/student-add', [StudentController::class, 'create']);
Route::post('/student', [StudentController::class, 'store']);
Route::get('/student-edit/{id}', [StudentController::class, 'edit']);
Route::put('/student/{id}', [StudentController::class, 'update']);

Route::post('/ekskul-add', [StudentController::class, 'addEkskul']);
Route::post('/ekskul-edit', [StudentController::class, 'editEkskul']);

Route::get('/class', [ClassController::class, 'index']);
Route::get('/class/{id}', [ClassController::class, 'show']);

Route::get('/extracurricular', [ExtracurricularController::class, 'index']);
Route::get('/extracurricular/{id}', [ExtracurricularController::class, 'show']);

Route::get('/teacher', [TeacherController::class, 'index']);
Route::get('/teacher/{id}', [TeacherController::class, 'show']);
