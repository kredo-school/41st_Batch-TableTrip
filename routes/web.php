<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// register  user information
// Route::get('/register', [RegisteredUserController::class, 'create'])
//     ->middleware('guest')
//     ->name('register');

// Route::post('/register', [RegisteredUserController::class, 'store'])
//     ->middleware('guest');

// edit user information
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UserController::class, 'show']);
    Route::get('/mypage/edit', [UserController::class, 'edit'])->name('mypage.edit');
    Route::delete('/mypage', [UserController::class, 'destroy'])->name('mypage.destroy');
    Route::put('/mypage', [UserController::class, 'update'])->name('mypage.update');
});