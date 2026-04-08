<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgetController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\CartController as UserCartController;
use App\Http\Controllers\User\FavoriteKitsController;
use App\Http\Controllers\User\FavoriteRestaurantsController;
use App\Http\Controllers\User\InquiryController;

// notifications
use App\Http\Controllers\Notifications\NotificationsController;


// home
use App\Http\Controllers\User\PaymentMethodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrdersController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\RestaurantAuthController;
use App\Http\Controllers\Owner\ReservationController as OwnerReservationController;
use App\Http\Controllers\Owner\OrdersController as OwnerOrdersController;
use App\Http\Controllers\Owner\ProductController as OwnerProductController;
use App\Http\Controllers\Owner\PageManagementController;
use App\Http\Controllers\Owner\ReviewsController as OwnerReviewsController;
use App\Http\Controllers\Owner\NotificationController as OwnerNotificationController;
//Restaurant
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PurchasedController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/',[HomeController::class,'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Notifications
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','verified'])->prefix('notifications')->name('notifications.')->group(function (){
    Route::get('/',[NotificationsController::class, 'index'])->name('index');
});
Route::get('/', [HomeController::class, 'index'])->name('home');

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

    // --- 1. Cart ---
    Route::prefix('user/cart')->name('user.')->group(function () {
        Route::get('/', [UserCartController::class, 'index'])->name('cart');
        Route::delete('/{cartItem}', [UserCartController::class, 'destroy'])->name('cart_destroy');
    });

    // --- Inquiry ---
    Route::prefix('inquiry')->name('user.inquiry.')->group(function () {
        Route::get('/', [InquiryController::class, 'dashboard'])->name('dashboard');
        Route::get('/chat/{thread_id}', [InquiryController::class, 'index'])->name('show');
        Route::post('/send', [InquiryController::class, 'send'])->name('send');
    });

    // --- 2. Purchased ---
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
    Route::get('/favorite/kits', [FavoriteKitsController::class, 'index'])->name('favorite_kits');
    Route::get('/favorite/restaurant', [FavoriteRestaurantsController::class, 'index'])->name('favorite_restaurants');
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

    // --- 6. Payment ---
    Route::resource('payment', PaymentController::class)->parameters(['payment' => 'card']);
    Route::patch('/payment-method/{payment_method}/default', [PaymentMethodController::class, 'setDefault'])->name('user.payment_method.default');

    // --- 7. Payment Method ---
    Route::prefix('user')->name('user.')->group(function () {
        Route::resource('payment_method', PaymentMethodController::class);
    });
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
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/orders', [AdminOrdersController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [AdminOrdersController::class, 'show'])->name('orders.show');
        Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
        Route::get('/reservations/{id}', [AdminReservationController::class, 'show'])->name('reservations.show');
    });

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/
Route::get('/products/create', [OrderController::class, 'create'])->name('products.create');
Route::get('/products', [OrderController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [OrderController::class, 'show'])->name('products.show');
Route::post('/products/store', [OrderController::class, 'store'])->name('products.store');
Route::get('/order/details', [OrderController::class, 'showDetails']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/confirm', function () { return view('products.confirm'); })->name('cart.confirm');
Route::get('/cart/thanks', function () { return view('products.thanks'); })->name('cart.thanks');
Route::get('/cart/track', function () { return view('products.track'); })->name('cart.track');

/*
|--------------------------------------------------------------------------
| Restaurant Page
|--------------------------------------------------------------------------
*/
Route::get('/restaurant/{id}', [RestaurantController::class, 'show'])->name('restaurant');
Route::post('/restaurant/{id}', [RestaurantController::class, 'store'])->name('restaurant.reserve');

/*
|--------------------------------------------------------------------------
| Restaurant Owner Routes
|--------------------------------------------------------------------------
*/
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

        // Reservations
        Route::get('/reservations', [OwnerReservationController::class, 'index'])->name('reservations');
        Route::post('/reservations', [OwnerReservationController::class, 'store'])->name('reservations.store');
        Route::patch('/reservations/{id}', [OwnerReservationController::class, 'update'])->name('reservations.update');
        Route::get('/reservations/{id}', [OwnerReservationController::class, 'show'])->name('reservations.show');

        // Orders
        Route::get('/orders', [OwnerOrdersController::class, 'index'])->name('orders');
        Route::get('/orders/{id}', [OwnerOrdersController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{id}', [OwnerOrdersController::class, 'update'])->name('orders.update');

        // Meal kits
        Route::get('/product', [OwnerProductController::class, 'index'])->name('products');
        Route::patch('/product/{id}/visibility', [OwnerProductController::class, 'toggleVisibility'])->name('products.toggleVisibility');
        Route::get('/product/create', [OwnerProductController::class, 'create'])->name('products.create');
        Route::post('/product/store', [OwnerProductController::class, 'store'])->name('products.store');
        Route::get('/product/{id}/edit', [OwnerProductController::class, 'edit'])->name('products.edit');
        Route::patch('/product/{id}', [OwnerProductController::class, 'update'])->name('products.update');
        Route::delete('/product/images/{id}', [OwnerProductController::class, 'destroyImage'])->name('products.images.destroy');
        Route::get('/product/{id}/details',[OwnerProductController::class,'show'])->name('products.details');

        //Page Management
        Route::get('/page-management', [PageManagementController::class, 'index'])->name('page-management');
        Route::get('/page-management/image', [PageManagementController::class, 'image'])->name('page-management.image');
        Route::get('/page-management/menu', [PageManagementController::class, 'menu'])->name('page-management.menu');
        Route::get('/page-management/preview', [PageManagementController::class, 'preview'])->name('page-management.preview');
        Route::patch('/page-management/basic-info', [PageManagementController::class, 'updateBasicInfo'])->name('page-management.updateBasicInfo');
        Route::patch('/page-management/image', [PageManagementController::class, 'updateImage'])->name('page-management.updateImage');
        Route::post('/page-management/menu', [PageManagementController::class, 'addMenu'])->name('page-management.addMenu');
        Route::patch('/page-management/menu/update/{id}', [PageManagementController::class, 'updateMenu'])->name('page-management.updateMenu');
        Route::post('/page-management/menu/', [PageManagementController::class, 'storeMenu'])->name('page-management.storeMenu');
        Route::delete('/page-management/menu/delete/{id}', [PageManagementController::class, 'deleteMenu'])->name('page-management.deleteMenu');

        // Reviews
        Route::get('/reviews', [OwnerReviewsController::class, 'index'])->name('reviews');
        Route::post('/reviews/{id}/reply', [OwnerReviewsController::class, 'reply'])->name('reviews.reply');

        // Notifications
        Route::get('/notifications', [OwnerNotificationController::class, 'index'])->name('notifications');


    });
});

/*
|--------------------------------------------------------------------------
| Static Views (for layout checking)
|--------------------------------------------------------------------------
*/
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
