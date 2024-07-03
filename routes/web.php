<?php

use App\Http\Controllers\StripeController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\ShopCartController;
use App\Models\OrderProduct;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// ============== Home Page ============
Route::get('/', [HomeController::class, 'index'])->name('home');

// ============== User Dashboard X Checkout==============
Route::middleware(['auth','verified'])->group(function () {
    Route::get('dashboard', [UserController::class,'dashboard'])->name('dashboard');

    Route::post('checkout', [StripeController::class, 'checkout'])->name('checkout');
    Route::get('checkout-success', [StripeController::class, 'success'])->name('checkout.success');
    Route::get('checkout-cancel', [StripeController::class, 'cancel'])->name('checkout.cancel');
    Route::post('/webhook', [StripeController::class, 'webhook'])->name('checkout.webhook');

    Route::get('orders-list', [OrderProductController::class, 'index'])->name('orders.list');
});

// ============== Guest Routes ================
Route::middleware('guest')->group(function () {
    Route::get('register', [UserController::class, 'create'])->name('register');
    Route::post('register', [UserController::class, 'store'])->name('user.store');
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class,'loginAuth'])->name('login.auth');
});

// ============== Email Verification X Logout ============
Route::middleware('auth')->group(function() {
    Route::get('/verify-email', function () {
        return view('user.verify-email');
    })->name('verification.notice');
     
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
     
        return redirect()->route('dashboard');
    })->middleware('signed')->name('verification.verify');
    
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:3,1')->name('verification.send');

    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::post('/storecomment', [HomeController::class, 'storeComment'])->name('home.store.comment');

    Route::resource('shopcart', ShopCartController::class)->except(['create', 'edit', 'show']);
});

// ============== Admin Routes ============
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('comments', CommentController::class)->except(['index', 'show']);
});

// ============== Home Routes ============
Route::prefix('home')->name('home.')->group(function() {
    Route::get('{title}/{id}', [HomeController::class, 'categoryProducts'])->name('category.products');
    Route::get('product/{id}/show', [HomeController::class, 'productShow'])->name('product.show');
    Route::get('product-search', [HomeController::class, 'search'])->name('products.search');
});


