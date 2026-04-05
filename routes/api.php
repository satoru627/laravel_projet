<?php

use App\Http\Controllers\PaypalWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/paypal/webhook', [PaypalWebhookController::class, 'handle'])
    ->middleware('throttle:60,1')
    ->name('paypal.webhook');
