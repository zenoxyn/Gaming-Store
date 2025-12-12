<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Seller\ApplicationController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SellerVerificationController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

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

    // Seller Application (for buyers who want to become sellers)
    Route::get('/seller/apply', [ApplicationController::class, 'showForm'])->name('seller.apply');
    Route::post('/seller/apply', [ApplicationController::class, 'submit'])->name('seller.apply.submit');

    // Buyer Dashboard
    Route::middleware('role:buyer')->group(function () {
        Route::get('/buyer/dashboard', function () {
            return view('dashboards.buyer');
        })->name('buyer.dashboard');
    });

    // Seller Dashboard
    Route::middleware(['role:seller', 'verified.seller'])->group(function () {
        Route::get('/seller/dashboard', function () {
            $user = Auth::user();

            // Debug info
            if (!$user->seller) {
                return redirect()->route('buyer.dashboard')
                    ->with('error', 'DEBUG: No seller account found. Please apply first.');
            }

            if ($user->seller->verification_status !== 'verified') {
                return redirect()->route('buyer.dashboard')
                    ->with('error', 'DEBUG: Seller status is ' . $user->seller->verification_status . '. Need verified status.');
            }

            return view('dashboards.seller');
        })->name('seller.dashboard');

        // Product Management
        Route::resource('seller/products', SellerProductController::class)->names([
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
        Route::resource('admin/categories', CategoryController::class)->names([
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]);

        // Product Management (Moderation only - no create)
        Route::get('admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
        Route::get('admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('admin/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
        Route::delete('admin/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

        // Seller Verification
        Route::get('admin/sellers/verification', [SellerVerificationController::class, 'index'])->name('admin.sellers.verification');
        Route::post('admin/sellers/{id}/approve', [SellerVerificationController::class, 'approve'])->name('admin.sellers.approve');
        Route::post('admin/sellers/{id}/reject', [SellerVerificationController::class, 'reject'])->name('admin.sellers.reject');
    });
});
