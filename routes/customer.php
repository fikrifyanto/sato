<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Customer\AuthController;

Route::prefix('customer')->name('customer.')->group(function () {
    // ✅ LOGIN & REGISTER
    Route::get('/login', function () {
        // Kalau sudah login, langsung ke dashboard
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.dashboard');
        }
        return app(AuthController::class)->showLogin();
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', function () {
        // Kalau sudah login, langsung ke dashboard
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.dashboard');
        }
        return app(AuthController::class)->showRegister();
    })->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    // ✅ DASHBOARD (hanya untuk yang login)
    Route::get('/dashboard', function () {
        // Kalau belum login, balikin ke login
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login');
        }
        return view('customer.dashboard');
    })->name('dashboard');

    // ✅ LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
