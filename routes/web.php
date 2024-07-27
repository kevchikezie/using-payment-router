<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentRoutingController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/test-payment-router', [PaymentRoutingController::class, 'processPayment']);
