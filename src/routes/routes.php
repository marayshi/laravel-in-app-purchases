<?php

use Illuminate\Support\Facades\Route;
use Imdhemy\Purchases\Http\Controllers\ServerNotificationController;

Route::post(
    '/api/google-webhook',
    [ServerNotificationController::class, 'google']
)->name('purchase.serverNotifications.google');

Route::post(
    '/api/apple-webhook',
    [ServerNotificationController::class, 'apple']
)->name('purchase.serverNotifications.apple');
