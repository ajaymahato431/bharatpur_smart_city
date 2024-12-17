<?php

use App\Http\Controllers\CertificateController;
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
// Route::get('/login', [PageController::class, 'login'])->name('login');
// Route::get('/form/birth-certificate-form', [PageController::class, 'birthCertificateForm'])->name('birthCertificateForm');


Route::get('/', [HomepageController::class, 'home'])->name('home');
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::post('/registration', [UserController::class, 'registration'])->name('registration');

Route::get('/birth-certificate/pdf/{id}', [CertificateController::class, 'birthCertificatePdf'])
    ->name('birth-certificate.pdf');
