<?php

use App\Http\Controllers\Customer\AddressController;
use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Middleware\ShareCartQty;
use Illuminate\Support\Facades\Route;


Route::middleware(ShareCartQty::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/products', [DashboardController::class, 'products'])->name('products');
    Route::get('/pets', [DashboardController::class, 'pets'])->name('pets');

    Route::get('/pets/{id}', [DashboardController::class, 'showPets'])->name('pet_detail');
    Route::get('/products/{id}', [DashboardController::class, 'showProduct'])->name('product_detail');

    Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
    Route::post('/update', [CartController::class, 'update'])->name('carts.update');
    Route::delete('/destroy/{id}', [CartController::class, 'destroy'])->name('carts.destroy');

    Route::resource('/orders', OrderController::class)->only(['index', 'store', 'show', 'destroy']);

    Route::middleware('guest:customer')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
    });

    Route::middleware('auth:customer')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/settings', [ProfileController::class, 'edit'])->name('settings');
        Route::put('/settings/profile', [ProfileController::class, 'update'])->name('settings.profile.update');
        Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password.update');

        Route::resource('/addresses', AddressController::class)->only(['store', 'update', 'destroy']);
    });
});
