<?php

use App\Http\Controllers\ImageUploaderController;
use App\Http\Middleware\CheckLoggedInMiddleware;
use App\Http\Controllers\AdminIndexController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Controllers\ShopPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\NoCache;

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
Route::get('/product/{id}', [ProductController::class, 'index'])->where('id', '[0-9]+')->name('product.view');

// Shop view
Route::get('/shop', [ShopPageController::class, 'index'])->name('shop');

// Auth Routes
Route::get('/login', [SessionController::class, 'create'])->name('login.get');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
Route::get('/register', [UserController::class, 'create'])->name('register.get');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

// Authenticated Routes
Route::middleware([CheckLoggedInMiddleware::class])->group(function () {
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.get');

    // Cart Routes
    // DON'T CACHE CART ROUTES, THEY CHANGE FREQUENTLY
    Route::middleware([NoCache::class])->group(function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    });

    // User Route
    Route::get('/account', [UserController::class, 'index'])->name('account.get');
    Route::post('/account/edit', [UserController::class, 'update'])->name('account.edit');

    // Admin Routes (must be logged in)
    Route::middleware([CheckAdminMiddleware::class])->group(function () {
        Route::get('/admin', [AdminIndexController::class, 'index'])->name('admin.index');
        Route::post('/admin/users/bulk-action', [AdminIndexController::class, 'bulkAction'])->name('users.bulk-action');

        Route::get('/admin/image-upload', [ImageUploaderController::class, 'index'])->name('image-upload.index');
        Route::post('/admin/image-upload/db', [ImageUploaderController::class, 'store_db'])->name('image-upload.store_db');
        Route::post('/admin/image-upload/static', [ImageUploaderController::class, 'store_static'])->name('image-upload.store_static');

        // DON'T CACHE CERTAIN ADMIN ROUTES, THEY CHANGE FREQUENTLY
        Route::middleware([NoCache::class])->group(function () {
            Route::get('/admin/manage-users', [AdminIndexController::class, 'index'])->name('manage-users');
            Route::get('/admin/manage-orders', [OrdersController::class, 'manage_orders'])->name('manage-orders');
            Route::get('/admin/manage-products', [ProductController::class, 'manage_products'])->name('manage-products');
            Route::get('/admin/stats', [AdminIndexController::class, 'stats'])->name('stats');
            Route::get('/admin/manage-products/{productId}/edit-product', [ProductController::class, 'index_edit'])->where('productId', '[0-9]+')->name('product.get.edit');
            Route::post('/admin/manage-products/{productId}/edit-product', [ProductController::class, 'update'])->where('productId', '[0-9]+')->name('product.update.pid');
            // TODO: change for controller
            Route::view("/admin/manage-products/add", "add-product");
        });

        // Only admins can view other people's accounts
        Route::get('/user/{userId}', [UserController::class, 'index'])->where('userId', '[0-9]+')->name('account.get.uid');
        Route::get('/user/{userId}/orders', [OrdersController::class, 'index'])->where('userId', '[0-9]+')->name('orders.get.uid');
        Route::post('/user/{userId}/edit', [UserController::class, 'update'])->where('userId', '[0-9]+')->name('account.edit.uid');
    });
});
