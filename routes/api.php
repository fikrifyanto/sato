<?php

use App\Http\Controllers\WebhookController;

Route::post('/webhook/midtrans', [WebhookController::class, 'midtrans'])->name('webhook.midtrans');
