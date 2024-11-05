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

Route::post('/contact', [MailController::class, 'send'])->name('contact.send');
