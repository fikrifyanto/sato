<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::guard('customer')->check()) {
        return redirect()->route('customer.dashboard');
    }
    return redirect()->route('customer.login');
});

require __DIR__.'/customer.php';


