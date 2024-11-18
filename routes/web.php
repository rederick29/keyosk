<?php

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

Route::get('/login', function () {
    return view('login');
});

Route::post('/contact', [MailController::class, 'send'])->name('contact.send');
