<?php

use App\Http\Controllers\AdminIndexController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\MailController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
 * For the first parameter, it is the URL path the user can visit (e.g. /about)
 * For the ->name() function, it is the name of the route in Laravel/Blade/PHP (e.g. route('index'))
 */

// Routes
Route::view('/', 'index')->name('index');
Route::view('/about', 'about-us')->name('about');
Route::get('/shop', function() {
    $products = Product::with('tags')->paginate(20);

    return view('shop', ['products' => $products]);
});

// Contact Routes
Route::view('/contact', 'contact-us')->name('contact');
Route::post('/contact', [MailController::class, 'send'])->name('contact.send');

// Product view
Route::get('/product/{id}', [ProductController::class, 'index']);

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
