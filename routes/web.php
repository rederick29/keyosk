<?php

use App\Http\Middleware\CheckLoggedInMiddleware;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\AdminIndexController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

/*
 * For the first parameter, it is the URL path the user can visit (e.g. /about)
 * For the ->name() function, it is the name of the route in Laravel/Blade/PHP (e.g. route('index'))
 */

// Routes
Route::view('/', 'index')->name('index');
Route::view('/about', 'about-us')->name('about');

// Contact Routes
Route::view('/contact', 'contact-us')->name('contact');
Route::post('/contact', [MailController::class, 'send'])->name('contact.send');

// Product view
Route::get('/product/{id}', [ProductController::class, 'index'])->where('id', '[0-9]+');

// Auth Routes
Route::get('/login', [SessionController::class, 'create'])->name('login.get');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
Route::get('/register', [RegisterUserController::class, 'create'])->name('register.get');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');

// Authenticated Routes
Route::middleware([CheckLoggedInMiddleware::class])->group(function () {
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

    // Admin Routes (must be logged in)
    Route::middleware([CheckAdminMiddleware::class])->group(function () {
        Route::get('/admin', [AdminIndexController::class, 'index'])->name('admin.index');
        Route::post('/admin/users/bulk-action', [AdminIndexController::class, 'bulkAction'])->name('users.bulk-action');
    });
});
