<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::guard('member')->check()) {
        return redirect()->route('member.dashboard');
    }
    return redirect()->route('member.login');
});

require __DIR__.'/member.php';


