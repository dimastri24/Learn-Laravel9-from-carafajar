<?php

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
    return view('welcome');
});

Route::get('/about', function () {
    return 'Ini About';
});

Route::get('/contact', function () {
    return view('contact', [
        'name' => 'cara Dimas',
        'phone' => '0812938231',
    ]);
});

// Route::view('/contact', 'contact', [
//     'name' => 'cara Dimas',
//     'phone' => '0812938231',
// ]);

// Route::redirect('/contact', '/contact-us');

Route::get('/product', function () {
    return 'product';
});

Route::get('/product/{id}', function ($id) {
    return view('product.detail', ['id' => $id]);
});

Route::prefix('administrator')->group(function () {
    Route::get('/profile-admin', function () {
        return 'profile-admin';
    });

    Route::get('/about-admin', function () {
        return 'about-admin';
    });

    Route::get('/contact-admin', function () {
        return 'contact-admin';
    });
});
