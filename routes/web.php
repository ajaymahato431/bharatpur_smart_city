<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('home');
});

Route::get('/demo', function () {
    return view('demo');
});



// Route::post('/translate', [TranslationController::class, 'translate'])->name('translate');
