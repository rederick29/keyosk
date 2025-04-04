<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ImageUploaderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
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

// Game Routes
Route::view('/games', 'games')->name('games');
Route::view('/games/click-test', 'click-speed-test')->name('click-speed');
Route::view('/games/type-test', 'type-speed-test')->name('type-speed');

// Company Routes
Route::view('/about', 'about-us')->name('about');
Route::view('/values', 'our-values')->name('values');
Route::view('/sustainability', 'sustainability')->name('sustainability');
Route::view('/faq', 'faq')->name('faq');

// Keyosk +
Route::view('/keyosk-plus', 'keyosk-plus')->name('keyosk-plus');

// Legal Routes
Route::view('/privacy', 'privacy-policy')->name('privacy');
Route::view('/tnc', 'terms-and-conditions')->name('terms.conditions');
Route::view('/ts', 'terms-of-sale')->name('terms.sale');
Route::view('/returns', 'returns-policy')->name('returns');

// Contact Routes
Route::redirect('/report-issue', '/contact');
Route::view('/contact', 'contact-us')->name('contact');
Route::post('/contact', [MailController::class, 'send'])->name('contact.send');

//Forgot Password route
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.forgot.get');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgot_password'])->name('password.forgot.post');
// laravel really wants these two routes looking exactly like this :D
Route::get('/reset-password', [ForgotPasswordController::class, 'index_reset'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset_password'])->name('password.reset.post');

// Product view
Route::get('/product/{id}', [ProductController::class, 'index'])->where('id', '[0-9]+')->name('product.view');
Route::get('/reviews/{reviewId}', [ReviewController::class, 'view'])->where('reviewId', '[0-9]+')->name('review.get');

// Shop view
Route::get('/shop', [ShopPageController::class, 'index'])->name('shop');

// Auth Routes
Route::get('/login', [SessionController::class, 'create'])->name('login.get');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
Route::get('/register', [UserController::class, 'create'])->name('register.get');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

// Cart Routes
// DON'T CACHE CART ROUTES, THEY CHANGE FREQUENTLY
Route::middleware([NoCache::class])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/checkout', [CheckoutController::class, 'index'])->name('checkout.get');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// Authenticated Routes
Route::middleware([CheckLoggedInMiddleware::class])->group(function () {
    // Order Routes
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.get');

    Route::post('/orders/{orderId}/cancel', [OrdersController::class, 'cancel'])->where('orderId', '[0-9]+')->name('orders.cancel');
    Route::post('/orders/{orderId}/refund', [OrdersController::class, 'refund'])->where('orderId', '[0-9]+')->name('orders.refund');

    // Review routes
    Route::get('/product/{productId}/review', [ReviewController::class, 'index'])->where('productId', '[0-9]+')->name('review.index');
    Route::post('/product/{productId}/review', [ReviewController::class, 'store'])->where('productId', '[0-9]+')->name('review.store');
    Route::post('/product/{productId}/review/edit', [ReviewController::class, 'update'])->where('productId', '[0-9]+')->name('review.update');
    Route::delete('/reviews/{reviewId}/delete', [ReviewController::class, 'destroy'])->where('reviewId', '[0-9]+')->name('review.delete');
    Route::get('/reviews', [ReviewController::class, 'bulk_index'])->name('reviews.bulk');

    // Wishlist Routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // User Routes
    Route::get('/account', [UserController::class, 'index'])->name('account.get');
    Route::post('/account/edit', [UserController::class, 'update'])->name('account.edit');
    Route::post('/account/delete', [UserController::class, 'destroy'])->name('account.delete');
    Route::post('/api/v1/address', [UserController::class, 'address'])->name('api.v1.address');

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
            Route::post('/admin/manage-orders/{orderId}/update', [OrdersController::class, 'update'])->where('orderId', '[0-9]+')->name('orders.update');
            Route::get('/admin/manage-products', [ProductController::class, 'manage_products'])->name('manage-products');
            Route::get('/admin/manage-products/{productId}/edit-product', [ProductController::class, 'index_edit'])->where('productId', '[0-9]+')->name('product.get.edit');
            Route::post('/admin/manage-products/{productId}/edit-product', [ProductController::class, 'update'])->where('productId', '[0-9]+')->name('product.update.pid');
            Route::post('/admin/manage-products/{productId}/delete', [ProductController::class, 'destroy'])->where('productId', '[0-9]+')->name('product.destroy.pid');
            Route::get('/admin/manage-products/add', [ProductController::class, 'index_add'])->name('product.add');
            Route::post('/admin/manage-products/add', [ProductController::class, 'store'])->name('product.add');
            Route::get('/admin/stats', [AdminIndexController::class, 'stats'])->name('admin.stats');
            Route::get('/admin/stats/best-selling', [AdminIndexController::class, 'stats_best_selling'])->name('admin.stats.best.selling');
            Route::get('/admin/stats/worst-selling', [AdminIndexController::class, 'stats_worst_selling'])->name('admin.stats.worst.selling');
            Route::get('/admin/stats/top-spending-users', [AdminIndexController::class, 'stats_top_spending_users'])->name('admin.stats.top.spending.users');
            Route::get('admin/stats/stock', [AdminIndexController::class, 'stats_low_stock'])->name('admin.stats.low.stock');
        });

        // Only admins can view other people's accounts
        Route::get('/user/{userId}', [UserController::class, 'index'])->where('userId', '[0-9]+')->name('account.get.uid');
        Route::get('/user/{userId}/orders', [OrdersController::class, 'index'])->where('userId', '[0-9]+')->name('orders.get.uid');
        Route::post('/user/{userId}/edit', [UserController::class, 'update'])->where('userId', '[0-9]+')->name('account.edit.uid');
        Route::post('/user/{userId}/delete', [UserController::class, 'destroy'])->where('userId', '[0-9]+')->name('account.delete.uid');
    });
});
