<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; // 名前が被るのでエイリアス設定
use App\Http\Controllers\DashboardController; // 一般ユーザー用
use App\Http\Controllers\ForgetController;  
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register
    Route::get('/user-register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/user-register', [RegisterController::class, 'store'])->name('register.store');

    // Password Recovery
    Route::get('forgot-password', [ForgetController::class, 'show'])->name('password.request');
    Route::post('forgot-password', [ForgetController::class, 'store'])->name('password.email');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- 2. My Page & Profile ---
    Route::prefix('mypage')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'show'])->name('show');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/', [UserController::class, 'update'])->name('update');
        Route::delete('/', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // --- 3. Reservation  ---
   Route::middleware(['auth'])->prefix('reservations')->name('reservations.')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('index');
    
    Route::post('/store', [ReservationController::class, 'store'])->name('store');

    Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');

    Route::patch('/{id}', [ReservationController::class, 'update'])->name('update');

    Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');
});
    // --- 4. Cart ---
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index'); // route('cart.index')
        Route::delete('/{cartItem}', [CartController::class, 'destroy'])->name('destroy');
    });
    Route::get('/cart-page', [CartController::class, 'index'])->name('cart');

    // --- 5. Payment ---
    Route::resource('payment', PaymentController::class)->parameters(['payment' => 'card']);
});

// admin
Route::prefix('admin')->group(function () {

    Route::get('/login',
        [AdminLoginController::class, 'showLoginForm']
    )->name('admin.login');

    Route::post('/login',
        [AdminLoginController::class, 'login']
    );

    Route::post('/logout',
        [AdminLoginController::class, 'logout']
    )->name('admin.logout');
});

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/dashboard',
            [DashboardController::class, 'index']
        )->name('admin.dashboard');

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

//Product
Route::get('/product', function () {
    return view('product.index');
});

// for checking layouts
Route::view('/restaurant-page', 'restaurants.restaurant_page');

Route::view('/restaurant-owner-page', 'restaurant-owners.register');
Route::view('/restaurant-owner-login', 'restaurant-owners.login');
Route::view('/restaurant-owner-dashboard', 'restaurant-owners.dashboard');
