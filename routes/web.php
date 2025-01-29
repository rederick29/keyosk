<?php

use App\Http\Controllers\ImageUploaderController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ShopPageController;
use App\Http\Middleware\CheckLoggedInMiddleware;
use App\Http\Controllers\AdminIndexController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

/*
 * For the first parameter, it is the URL path the user can visit (e.g. /about)
 * For the ->name() function, it is the name of the route in Laravel/Blade/PHP (e.g. route('index'))
 */

// Routes
Route::view('/', 'index')->name('index');

// Company Routes
Route::view('/about', 'about-us')->name('about');
Route::view('/values', 'our-values')->name('values');
Route::view('/sustainability', 'sustainability')->name('sustainability');
Route::view('/faq', 'faq')->name('faq');

// Legal Routes
Route::view('/privacy', 'privacy-policy')->name('privacy');
Route::view('/tnc', 'terms-and-conditions')->name('terms.conditions');
Route::view('/ts', 'terms-of-sale')->name('terms.sale');
Route::view('/returns', 'returns-policy')->name('returns');

// Contact Routes
Route::redirect('/report-issue', '/contact');
Route::view('/contact', 'contact-us')->name('contact');
Route::post('/contact', [MailController::class, 'send'])->name('contact.send');

// Product view
Route::get('/product/{id}', [ProductController::class, 'index'])->where('id', '[0-9]+');

// Shop view
Route::get('/shop', [ShopPageController::class, 'index'])->name('shop');

// tmp account view
Route::view('/account', 'account')->name('account');

// Auth Routes
Route::get('/login', [SessionController::class, 'create'])->name('login.get');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
Route::get('/register', [RegisterUserController::class, 'create'])->name('register.get');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');

// Authenticated Routes
Route::middleware([CheckLoggedInMiddleware::class])->group(function () {
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.get');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

    // Account Routes

    // Admin Routes (must be logged in)
    Route::middleware([CheckAdminMiddleware::class])->group(function () {
        Route::get('/admin', [AdminIndexController::class, 'index'])->name('admin.index');
        Route::post('/admin/users/bulk-action', [AdminIndexController::class, 'bulkAction'])->name('users.bulk-action');

        Route::get('/admin/image-upload', [ImageUploaderController::class, 'index'])->name('image-upload.index');
        Route::post('/admin/image-upload/db', [ImageUploaderController::class, 'store_db'])->name('image-upload.store_db');
        Route::post('/admin/image-upload/static', [ImageUploaderController::class, 'store_static'])->name('image-upload.store_static');
    });
});
