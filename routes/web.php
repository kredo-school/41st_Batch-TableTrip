<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ForgetController;  
use App\Http\Controllers\User\PaymentMethodController;  
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\FavoriteKitsController;
use App\Http\Controllers\User\FavoriteRestaurantsController;


//Admin
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; // 名前が被るのでエイリアス設定
use App\Http\Controllers\Admin\AdminOrdersController;


//Restaurant Owner
use App\Http\Controllers\Owner\RestaurantAuthController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\ReservationController as OwnerReservationController;
use App\Http\Controllers\Owner\OrdersController as OwnerOrdersController;
use App\Http\Controllers\owner\ProductController as OwnerProductController;

//Restaurant
use App\Http\Controllers\RestaurantController;

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PurchasedController; 

//Product
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\owner\ProductController;

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
    Route::prefix('user/cart')->name('user.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart'); 
        Route::delete('/{cartItem}', [CartController::class, 'destroy'])->name('cart_destroy');
    });

// --- 2. Purchased\
    Route::get('/purchased', [PurchasedController::class, 'index'])->name('purchased.index');
// Visited
    // Route::get('/visited', [VisitedController::class, 'index'])->name('visited.index');

// --- 3. My Page & Profile  ---
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
});

    
    // --- Payment ---
    Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
        Route::resource('payment_method', PaymentMethodController::class);
});
   

    

    // --- 3. Reservation  ---
   Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index');
        Route::post('/store', [ReservationController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [ReservationController::class, 'update'])->name('update');
        Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');
    });

    // --- 5. Favorites ---
    Route::get('/favorite/kits', [FavoriteKitsController::class, 'index'])->name('favoritekits');
    Route::get('/favorite/restaurant', [FavoriteRestaurantsController::class, 'index'])->name('favoriterestaurants');
    
    // --- 5. Payment ---
    Route::resource('payment', PaymentController::class)->parameters(['payment' => 'card']);
    Route::patch('/payment-method/{payment_method}/default', [PaymentMethodController::class, 'setDefault'])->name('user.payment_method.default');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);
});

Route::prefix('admin')->middleware(['auth']) ->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout',[AdminLoginController::class, 'logout'])->name('admin.logout');
});


//Product
// 登録画面を表示するURL
Route::get('/products/create', [OrderController::class, 'create'])->name('products.create');

Route::get('/products', [OrderController::class, 'index'])->name('products.index');

Route::get('/products/{id}', [OrderController::class, 'show'])->name('products.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/cart/confirm', function () {
    return view('products.confirm');
})->name('cart.confirm');

Route::get('/cart/thanks', function () {
    return view('products.thanks');
})->name('cart.thanks');

Route::get('/cart/track', function () {
    return view('products.track');
})->name('cart.track');

Route::middleware(['auth'])->group(function () {
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});

Route::get('/order/details', [OrderController::class, 'showDetails']);

Route::post('/products/store', [OrderController::class, 'store'])->name('products.store');

// Admin Orders Table //
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/orders', [AdminOrdersController::class, 'index'])->name('admin.orders');
});

// Admin Order Detail Page //
Route::get('/orders/{order}', [AdminOrdersController::class, 'show'])
    ->name('admin.orders.show');


//Restaurant Page
Route::get('/restaurant',[RestaurantController::class,'show'])->name('restaurant');

//Restaurant Owner
Route::prefix('owner')->name('owner.')->group(function () {

    Route::get('/register', [RestaurantAuthController::class, 'create'])->name('register');
    Route::post('/register', [RestaurantAuthController::class, 'store'])->name('register.store');
    Route::get('/login', [RestaurantAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [RestaurantAuthController::class, 'login'])->name('login.submit');

    Route::middleware('auth:restaurant')->group(function () {
        Route::post('/logout', [RestaurantAuthController::class, 'logout'])->name('logout');
        Route::get('/', [OwnerDashboardController::class, 'index'])->name('dashboard');

        //Reservations
        Route::get('/reservations',[OwnerReservationController::class,'index'])->name('reservations');
        Route::post('/reservations',[OwnerReservationController::class,'store'])->name('reservations.store');
        Route::patch('/reservations/{id}',[OwnerReservationController::class,'update'])->name('reservations.update');
        Route::get('/reservations/{id}',[OwnerReservationController::class,'show'])->name('reservations.show');

        //Orders
        Route::get('/orders',[OwnerOrdersController::class,'index'])->name('orders');
        Route::get('/orders/{id}',[OwnerOrdersController::class,'show'])->name('orders.show');
        Route::patch('/orders/{id}',[OwnerOrdersController::class,'update'])->name('orders.update');

        //Meal kits
        Route::get('/product',[OwnerProductController::class,'index'])->name('products');
        Route::patch('/product/{id}/visibility',[OwnerProductController::class,'toggleVisibility'])->name('products.toggleVisibility');
        Route::get('/product/create',[OwnerProductController::class,'create'])->name('products.create');
        Route::post('/product/store',[OwnerProductController::class,'store'])->name('products.store');
        Route::get('/product/{id}/edit',[OwnerProductController::class,'edit'])->name('products.edit');
        Route::patch('/product/{id}',[OwnerProductController::class,'update'])->name('products.update');
        Route::delete('/product/images/{id}', [OwnerProductController::class, 'destroyImage'])->name('products.images.destroy');
        

    });
});
