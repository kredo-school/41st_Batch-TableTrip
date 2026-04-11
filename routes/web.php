<?php

// search
use App\Http\Controllers\Search\SearchController;

// user
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\ForgetPasswordController;

//Admin
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController as AdminDashboardController; // 名前が被るのでエイリアス設定
use App\Http\Controllers\Admin\AdminOrdersController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminInquiryController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminRewardController;


// use App\Http\Controllers\ForgetPasswordController;  
use App\Http\Controllers\ForgetController;  
use App\Http\Controllers\User\PaymentMethodController;  
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\CartController as UserCartController;
use App\Http\Controllers\User\FavoriteKitsController;
use App\Http\Controllers\User\FavoriteRestaurantsController;
use App\Http\Controllers\User\InquiryController;


// notifications
use App\Http\Controllers\User\NotificationsController;


// home
use App\Http\Controllers\HomeController;

//Restaurant Owner
use App\Http\Controllers\Owner\RestaurantAuthController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\ReservationController as OwnerReservationController;
use App\Http\Controllers\Owner\OrdersController as OwnerOrdersController;
use App\Http\Controllers\Owner\ProductController as OwnerProductController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PurchasedController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Owner\PageManagementController;
use App\Http\Controllers\Owner\ReviewController as OwnerReviewController;
use App\Models\User;
use App\Http\Controllers\Owner\NotificationController as OwnerNotificationController;

/*
|--------------------------------------------------------------------------
| Search
|--------------------------------------------------------------------------
*/
Route::get('/search', [SearchController::class, 'index'])->name('search');
/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

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
    // Password Reset 
   Route::get('forgot-password', [ForgetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    // Reset Password (Step 2)
    Route::get('reset-password/{token}', [ForgetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ForgetPasswordController::class, 'updatePassword'])->name('password.update');
});
/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Auth)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // hisotry
    Route::get('/purchased', [PurchasedController::class, 'index'])->name('purchased.index');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::get('/favorite/restaurant', [FavoriteRestaurantsController::class, 'index'])->name('user.favorite_restaurants');
    Route::get('/favorite/kits', [FavoriteKitsController::class, 'index'])->name('user.favoritekits');

    // reservation
    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index');
        Route::post('/store', [ReservationController::class, 'store'])->name('store');
        Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [ReservationController::class, 'update'])->name('update');
    });

    // inquiry
    Route::prefix('inquiry')->name('user.inquiry.')->group(function () {
        Route::get('/', [InquiryController::class, 'dashboard'])->name('dashboard');
        Route::get('/chat/{thread_id}', [InquiryController::class, 'index'])->name('show');
        Route::post('/send', [InquiryController::class, 'send'])->name('send');
    });

    // --- User
    Route::prefix('user')->name('user.')->group(function () {

        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        Route::patch('/update', [UserController::class, 'update'])->name('update');
        Route::delete('/destroy', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');

        Route::prefix('cart')->group(function () {
            Route::get('/', [UserCartController::class, 'index'])->name('cart');
            Route::delete('/{cartItem}', [UserCartController::class, 'destroy'])->name('cart_destroy');
        });

        // notification)
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [NotificationsController::class, 'index'])->name('index');
            Route::get('/{id}', [NotificationsController::class, 'show'])->name('show');
            Route::patch('/{id}/complete', [NotificationsController::class, 'complete'])->name('complete');
            Route::delete('/{id}', [NotificationsController::class, 'destroy'])->name('destroy');
        });

        // payment
        Route::resource('payment_method', PaymentMethodController::class);
    });

    // checkout
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
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/orders', [AdminOrdersController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{id}', [AdminOrdersController::class, 'show'])
            ->name('orders.show');

        Route::get('/reservations', [AdminReservationController::class, 'index'])
            ->name('reservations.index');

        Route::get('/reservations/{id}', [AdminReservationController::class, 'show'])
            ->name('reservations.show');

        Route::post('/reservations/{id}/status', [AdminReservationController::class, 'updateStatus'])
            ->name('reservations.updateStatus');

        Route::get('/inquiries', [AdminInquiryController::class, 'index'])
            ->name('inquiries.index');
        
        Route::get('/inquiries/{id}', [AdminInquiryController::class, 'show'])
            ->name('inquiries.show');
        
        Route::patch('/inquiries/{id}/status', [AdminInquiryController::class, 'updateStatus'])
            ->name('inquiries.updateStatus');

        Route::get('/inquiries/{id}/reply', [AdminInquiryController::class, 'replyForm'])
            ->name('inquiries.replyForm');
        
        Route::post('/inquiries/{id}/reply', [AdminInquiryController::class, 'sendReply'])
            ->name('inquiries.sendReply');

        Route::get('/reviews', [AdminReviewController::class, 'index'])
            ->name('reviews.index');

        Route::get('/reviews/{id}', [AdminReviewController::class, 'show'])
            ->name('reviews.show');
        
        Route::patch('/reviews/{id}/status', [AdminReviewController::class, 'updateStatus'])
            ->name('reviews.updateStatus');

        Route::delete('/reviews/{id}', [AdminReviewController::class, 'destroy'])
            ->name('reviews.destroy');

        Route::get('/rewards/point-history', [AdminRewardController::class, 'pointHistory'])
            ->name('rewards.points.history');

        // Route::get('/admin/rewards', [AdminRewardController::class, 'dashboard']);

        Route::post('/logout', [AdminLoginController::class, 'logout'])
            ->name('logout');
    });

//Product
// 登録画面を表示するURL

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
Route::get('/cart/confirm', [CartController::class, 'confirm'])->name('cart.confirm');
Route::get('/cart/thanks', [CartController::class, 'thanks'])->name('cart.thanks');
Route::get('/cart/order-details', [CartController::class, 'orderDetails'])->name('cart.order_details');
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
        Route::get('/product/{id}/details', [OwnerProductController::class, 'show'])->name('products.details');   
        
        //Page Management
        Route::get('/page-management', [PageManagementController::class, 'index'])->name('page-management');
        Route::get('/page-management/image', [PageManagementController::class, 'image'])->name('page-management.image');
        Route::get('/page-management/menu', [PageManagementController::class, 'menu'])->name('page-management.menu');
        Route::get('/page-management/preview', [PageManagementController::class, 'preview'])->name('page-management.preview');
        Route::patch('/page-management', [PageManagementController::class, 'updateBasicInfo'])->name('page-management.updateBasicInfo');
        Route::patch('/page-management/image', [PageManagementController::class, 'updateImage'])->name('page-management.updateImage');
        Route::post('/page-management/menu', [PageManagementController::class, 'storeMenu'])->name('page-management.storeMenu');
        Route::patch('/page-management/menu/update/{id}', [PageManagementController::class, 'updateMenu'])->name('page-management.updateMenu');
        Route::post('/page-management/menu/', [PageManagementController::class, 'storeMenu'])->name('page-management.storeMenu');
        Route::delete('/page-management/menu/delete/{id}', [PageManagementController::class, 'deleteMenu'])->name('page-management.deleteMenu');

        // Reviews
        Route::get('/reviews', [OwnerReviewController::class, 'index'])->name('reviews');
        Route::post('/reviews/{id}/reply', [OwnerReviewController::class, 'reply'])->name('reviews.reply');

        // Notifications
        Route::get('/notifications', [OwnerNotificationController::class, 'index'])->name('notifications');
        Route::patch('/notifications/{id}/read', [OwnerNotificationController::class, 'markAsRead'])->name('notifications.read');

        // Settings
        Route::get('/setting', [RestaurantAuthController::class, 'changePassword'])->name('setting');
        Route::patch('/setting', [RestaurantAuthController::class, 'updatePassword'])->name('setting.updatePassword');



    });
});
