<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/demo', function () {
    return view('demo');
});

// Route::post('/translate', [TranslationController::class, 'translate'])->name('translate');

Route::get('/', [HomepageController::class, 'home'])->name('home');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/register', [PageController::class, 'register'])->name('register');

Route::get('/form/birth-certificate-form', [PageController::class, 'birthCertificateForm'])->name('birthCertificateForm');

Route::post('/user-register', [UserController::class, 'userRegistration'])->name('userRegistration');
