<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

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
Route::view('/restaurant-owner-reservations', 'restaurant-owners.reservations');
