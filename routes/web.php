<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/demo', function () {
    return view('demo');
});

// Route::post('/translate', [TranslationController::class, 'translate'])->name('translate');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/register', [PageController::class, 'register'])->name('register');

Route::post('/user-register', [UserController::class, 'userRegistration'])->name('userRegistration');
