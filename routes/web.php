<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

// Public Routes
Route::get('/', [ProductController::class, 'index'])->name('home');

// Product type routes
Route::get('/account', function () {
    return app(ProductController::class)->listByType('account');
})->name('products.account');

Route::get('/in-game-items', function () {
    return app(ProductController::class)->listByType('in-game-items');
})->name('products.ingame');

Route::get('/top-up', function () {
    return app(ProductController::class)->listByType('top-up');
})->name('products.topup');

// Category routes
Route::get('/category/{slug}', [ProductController::class, 'listByCategory'])->name('products.category');

// Product detail
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Search
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

// Testing Routes
Route::get('/test', [TestController::class, 'index']);
Route::get('/api/test/categories', [TestController::class, 'categories']);
Route::get('/api/test/products', [TestController::class, 'products']);
Route::get('/api/test/users', [TestController::class, 'users']);

// Authentication Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Protected Routes (Authenticated users only)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Buyer Dashboard
    Route::middleware('role:buyer,both')->group(function () {
        Route::get('/buyer/dashboard', function () {
            return view('dashboards.buyer');
        })->name('buyer.dashboard');
    });

    // Seller Dashboard
    Route::middleware('role:seller,both')->group(function () {
        Route::get('/seller/dashboard', function () {
            return view('dashboards.seller');
        })->name('seller.dashboard');

        // Product Management
        Route::resource('seller/products', \App\Http\Controllers\Seller\ProductController::class)->names([
            'index' => 'seller.products.index',
            'create' => 'seller.products.create',
            'store' => 'seller.products.store',
            'edit' => 'seller.products.edit',
            'update' => 'seller.products.update',
            'destroy' => 'seller.products.destroy',
        ]);
    });

    // Admin Dashboard
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboards.admin');
        })->name('admin.dashboard');

        // Category Management
        Route::resource('admin/categories', \App\Http\Controllers\Admin\CategoryController::class)->names([
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]);
    });
});
