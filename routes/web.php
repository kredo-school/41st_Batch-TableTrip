<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PurchasedController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;

// Admin
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; // 名前が被るのでエイリアス設定
use App\Http\Controllers\DashboardController; // 一般ユーザー用

// use App\Http\Controllers\ForgetController;  

use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;

//Restaurant
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Favorite_KitsController;
use App\Http\Controllers\Favorite_RestaurantsController;

//Restaurant Owner
use App\Http\Controllers\Owner\RestaurantAuthController;

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
    // Route::get('forgot-password', [ForgetController::class, 'show'])->name('password.request');
    // Route::post('forgot-password', [ForgetController::class, 'store'])->name('password.email');
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

    // ---  Reservation  ---
   Route::middleware(['auth'])->prefix('reservations')->name('reservations.')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('index');
    
    Route::post('/store', [ReservationController::class, 'store'])->name('store');

    Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');

    Route::patch('/{id}', [ReservationController::class, 'update'])->name('update');

    Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');
});
    // ---  Cart ---
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index'); // route('cart.index')
        Route::delete('/{cartItem}', [CartController::class, 'destroy'])->name('destroy');
    });
    Route::get('/cart-page', [CartController::class, 'index'])->name('cart');
    });


   // favorite zone
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/favorite/kits', [Favorite_KitsController::class, 'index'])->name('favorite_kits');
    Route::get('/favorite/restaurant', [Favorite_RestaurantsController::class, 'index'])->name('favorite_restaurants');
    // purchased
Route::get('/purchased', [PurchasedController::class, 'index'])->name('purchased.index');
});
    
    // --- Payment ---
    Route::resource('payment', PaymentController::class)->parameters(['payment' => 'card']);
    // --- 3. Reservation  ---
   Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index');            
        Route::post('/store', [ReservationController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [ReservationController::class, 'update'])->name('update');
        Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');
    });

    // --- 4. Cart ---
    // Route::prefix('cart')->name('cart.')->group(function () {
    //     Route::get('/', [CartController::class, 'index'])->name('index'); // route('cart.index')
    //     Route::delete('/{cartItem}', [CartController::class, 'destroy'])->name('destroy');
    // });
    
//     Route::get('/cart-page', [CartController::class, 'index'])->name('cart');
//     // --- 5. Payment ---
//     Route::resource('payment', PaymentController::class)->parameters(['payment' => 'card']);
// });


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



//Product
// Route::get('/product', function () {
//     return view('product.index');
// });
Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/products/{id}', function ($id) {
    return view('products.show'); 
})->name('products.show');

Route::get('/cart', function () {
    return view('products.cart');
})->name('cart.index');

Route::get('/cart/confirm', function () {
    return view('products.confirm');
})->name('cart.confirm');

Route::get('/cart/thanks', function () {
    return view('products.thanks');
})->name('cart.thanks');

// for checking layouts
Route::view('/restaurant-page', 'restaurants.restaurant_page');
Route::view('/restaurant-owner-page', 'restaurant-owners.register');
Route::view('/restaurant-owner-login', 'restaurant-owners.login');
Route::view('/restaurant-owner-dashboard', 'restaurant-owners.dashboard');
Route::view('/restaurant-owner-reservations', 'restaurant-owners.reservations.index');
Route::view('/restaurant-owner-reservation-details', 'restaurant-owners.reservations.reservation-details');
Route::view('/restaurant-owner-orders', 'restaurant-owners.orders.index');
Route::view('/restaurant-owner-order-details', 'restaurant-owners.orders.order-details');
Route::view('/restaurant-owner-meal-kit', 'restaurant-owners.meal_kits.index');
Route::view('/restaurant-owner-meal-kit-add', 'restaurant-owners.meal_kits.add-mealkit');
Route::view('/restaurant-owner-meal-kit-details', 'restaurant-owners.meal_kits.details');
Route::view('/restaurant-owner-page-info', 'restaurant-owners.page-management.basic-info');
Route::view('/restaurant-owner-page-image', 'restaurant-owners.page-management.image');
Route::view('/restaurant-owner-page-menu', 'restaurant-owners.page-management.menu');
Route::view('/restaurant-owner-page-preview', 'restaurant-owners.page-management.preview');
Route::view('/restaurant-owner-review', 'restaurant-owners.review.index');
Route::view('/restaurant-owner-notifications', 'restaurant-owners.notifications.index');
Route::view('/restaurant-owner-setting', 'restaurant-owners.setting.index');

//Restaurant Page
Route::get('/restaurant',[RestaurantController::class,'show'])->name('restaurant');

//Restaurant Owner
Route::prefix('owner')->name('owner.')->group(function () {

    Route::middleware('guest:restaurant')->group(function () {
        Route::get('/register', [RestaurantAuthController::class, 'create'])->name('register');
        Route::post('/register', [RestaurantAuthController::class, 'store'])->name('register.store');

        Route::get('/login', [RestaurantAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [RestaurantAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware('auth:restaurant')->group(function () {
        Route::post('/logout', [RestaurantAuthController::class, 'logout'])->name('logout');
        Route::get('/', [OwnerDashboardController::class, 'index'])->name('dashboard');
    });

});