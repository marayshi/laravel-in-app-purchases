<?php

use Illuminate\Support\Facades\Route;
use Imdhemy\Purchases\Http\Controllers\ServerNotificationController;

Route::post(
    '/google-webhook',
    [ServerNotificationController::class, 'google']
)->name('purchase.serverNotifications.google');

Route::post(
    '/apple-webhook',
    [ServerNotificationController::class, 'apple']
)->name('purchase.serverNotifications.apple');
