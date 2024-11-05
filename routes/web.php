<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/development', function () {
    return view('contact-us');
});

Route::post('/development', [MailController::class, 'send'])->name('development.send');
