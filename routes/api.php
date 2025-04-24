<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Product Routes
Route::apiResource('products', ProductController::class);

// Customer Routes
Route::apiResource('customers', CustomerController::class);

// Order Routes
Route::apiResource('orders', OrderController::class);

// Additional order routes
Route::post('/orders/{order}/process', [OrderController::class, 'process']);
Route::post('/orders/{order}/ship', [OrderController::class, 'ship']);
Route::post('/orders/{order}/complete', [OrderController::class, 'complete']);