<?php

use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

// Default route for site.
Route::get('/', function() {
    return view('index');
});

Route::get('/contact', function () {
    return view('contact-us');
});

Route::get('/about', function () {
    return view('about-us');
});

Route::post('/contact', [MailController::class, 'send'])->name('contact.send');

Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
