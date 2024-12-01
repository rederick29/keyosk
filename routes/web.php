<?php

use App\Http\Controllers\AdminIndexController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\MailController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Routes
Route::view('/', 'index')->name('index');
Route::view('/about', 'about-us')->name('about');

// Contact Routes
Route::view('/contact', 'contact-us')->name('contact');
Route::post('/contact', [MailController::class, 'send'])->name('contact.send');

// Auth Routes
Route::get('/login', [SessionController::class, 'create'])->name('login.get');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
Route::get('/register', [RegisterUserController::class, 'create'])->name('register.get');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');

// Admin Routes
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminIndexController::class, 'index'])->name('admin.index');
    Route::post('/admin/users/bulk-action', [AdminIndexController::class, 'bulkAction'])->name('users.bulk-action');
});
