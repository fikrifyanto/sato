<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ProfileController;

// Semua URL customer diawali dengan /customer
Route::prefix('customer')->name('customer.')->group(function () {

    // =======================
    // 🔐 AUTH (login & register)
    // =======================
    Route::middleware('guest:customer')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
    });

    // =======================
    // 🧭 DASHBOARD & PRODUCT (hanya login)
    // =======================
    Route::middleware('auth:customer')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/products', [DashboardController::class, 'products'])->name('products');
        Route::get('/pets', [DashboardController::class, 'pets'])->name('pets');

        Route::get('/pets/{id}', [DashboardController::class, 'showPets'])->name('pet_detail');
        Route::get('/products/{id}', [DashboardController::class, 'showProduct'])->name('product_detail');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Route::get('/order-list', [ProfileController::class, 'orderlist'])->name('order.list');
        Route::get('/settings', [ProfileController::class, 'edit'])->name('settings');
        Route::put('/settings/profile', [ProfileController::class, 'update'])->name('settings.profile.update');
        Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password.update');
    });
});
