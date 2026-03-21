<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ForgetController;  
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PurchasedController; 
use App\Http\Controllers\Favorite_KitsController;
use App\Http\Controllers\Favorite_RestaurantsController;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/user-register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/user-register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('forgot-password', [ForgetController::class, 'show'])->name('password.request');
    Route::post('forgot-password', [ForgetController::class, 'store'])->name('password.email');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // --- Dashboard ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- 1. Cart \
    Route::prefix('cart')->name('user.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart'); 
        Route::delete('/{cartItem}', [CartController::class, 'destroy'])->name('cart_destroy');
    });

    // --- 2. Purchased\
    Route::get('/purchased', [PurchasedController::class, 'index'])->name('purchased.index');

    // --- 3. My Page & Profile ---
    Route::prefix('mypage')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'show'])->name('show');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/', [UserController::class, 'update'])->name('update');
        Route::delete('/', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // --- 4. Reservation ---
    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index');
        Route::post('/store', [ReservationController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [ReservationController::class, 'update'])->name('update');
        Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');
    });

    // --- 5. Favorites ---
    Route::get('/favorite/kits', [Favorite_KitsController::class, 'index'])->name('favorite_kits');
    Route::get('/favorite/restaurant', [Favorite_RestaurantsController::class, 'index'])->name('favorite_restaurants');
    
    // --- 6. Payment ---
    Route::resource('payment', PaymentController::class)->parameters(['payment' => 'card']);
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth'])->group(function () {
        // Admin用Dashboardは別物ならここをAdminDashboardControllerに変える必要があります
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });
});

// --- Layout Checks & Static Views ---
Route::view('/restaurant-owner-page', 'restaurant-owners.register')->name('owner.register');
Route::view('/restaurant-owner-login', 'restaurant-owners.login')->name('owner.login');
Route::view('/restaurant-owner-dashboard', 'restaurant-owners.dashboard')->name('owner.dashboard');