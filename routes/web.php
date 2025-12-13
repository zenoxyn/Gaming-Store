<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\NegotiationController;
use App\Http\Controllers\CoinFlipController;
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

// Midtrans Callback (No auth - called by Midtrans server)
Route::post('/wallet/callback', [WalletController::class, 'callback'])->name('wallet.callback');

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

    // Wallet Routes (All authenticated users)
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallet/topup', [WalletController::class, 'topup'])->name('wallet.topup');
    Route::post('/wallet/topup/process', [WalletController::class, 'processTopup'])->name('wallet.topup.process');
    Route::get('/wallet/success', [WalletController::class, 'success'])->name('wallet.success');
    Route::get('/wallet/pending', [WalletController::class, 'pending'])->name('wallet.pending');
    Route::get('/wallet/error', [WalletController::class, 'error'])->name('wallet.error');

    // Negotiation Routes
    Route::get('/negotiations', [NegotiationController::class, 'index'])->name('negotiation.index');
    Route::get('/negotiations/{id}', [NegotiationController::class, 'show'])->name('negotiation.show');
    Route::get('/product/{productId}/negotiate', [NegotiationController::class, 'create'])->name('negotiation.create');
    Route::post('/product/{productId}/negotiate', [NegotiationController::class, 'store'])->name('negotiation.store');
    Route::post('/negotiations/{id}/counter', [NegotiationController::class, 'counter'])->name('negotiation.counter');
    Route::post('/negotiations/{id}/accept', [NegotiationController::class, 'accept'])->name('negotiation.accept');
    Route::post('/negotiations/{id}/reject', [NegotiationController::class, 'reject'])->name('negotiation.reject');
    Route::post('/negotiations/{id}/pay', [NegotiationController::class, 'payAcceptedOffer'])->name('negotiation.pay');
    Route::post('/negotiations/{id}/coinflip', [NegotiationController::class, 'initiateCoinFlip'])->name('negotiation.coinflip');

    // Coin Flip Routes
    Route::get('/coinflip/{id}', [CoinFlipController::class, 'show'])->name('coinflip.show');
    Route::post('/coinflip/{id}/deposit', [CoinFlipController::class, 'payDeposit'])->name('coinflip.payDeposit');
    Route::post('/coinflip/{id}/choose', [CoinFlipController::class, 'chooseSide'])->name('coinflip.choose');
    Route::get('/coinflip/{id}/result', [CoinFlipController::class, 'result'])->name('coinflip.result');
    Route::post('/coinflip/{id}/pay', [CoinFlipController::class, 'payRemaining'])->name('coinflip.payRemaining');

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
