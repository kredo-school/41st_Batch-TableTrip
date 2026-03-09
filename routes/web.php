<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ForgetController;  
use App\Http\Controllers\PaymentController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// My page
    // edit user account
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UserController::class, 'show'])->name('user.show');
    Route::get('/mypage/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/mypage', [UserController::class, 'update'])->name('user.update');
    Route::delete('/mypage', [UserController::class, 'destroy'])->name('user.destroy');
});

    // login  user
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth')->group(function () {
    // logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    
    // illustlate profile
Route::get('/profile', [UserController::class, 'show'])->name('user.show');
});

    // register user
Route::middleware('guest')->group(function () {
    Route::get('/user-register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/user-register', [RegisterController::class, 'store'])->name('register.store');
});
    // forgotten password
Route::get('forgot-password', [ForgetController::class, 'show'])->name('password.request');
Route::post('forgot-password', [ForgetController::class, 'store'])->name('password.email');


// payment
Route::middleware('auth')->group(function() {
    Route::resource('payment', PaymentController::class)
        ->parameters(['payment' => 'card']); 
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Product
Route::get('/product', function () {
    return view('product.index');
});

// for checking layouts
Route::view('/restaurant-page', 'restaurants.restaurant_page');

Route::view('/restaurant-owner-page', 'restaurant-owners.register');
Route::view('/restaurant-owner-login', 'restaurant-owners.login');
Route::view('/restaurant-owner-dashboard', 'restaurant-owners.dashboard');
