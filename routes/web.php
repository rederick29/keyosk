<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

// Default route for site.
Route::get('/', function() {
    return view('index');
});

Route::get('/development', function () {
    return view('contact-us');
});

Route::post('/development', [MailController::class, 'send'])->name('development.send');
