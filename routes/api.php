<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('users', [AuthController::class, 'users']);
});

//Register
Route::post('register', [AuthController::class, 'register']);

//Login
Route::post('login', [AuthController::class, 'login']);

// Products
Route::get('products', [ProductController::class, 'products']);

//Cart
Route::post('order', [OrderController::class, 'checkout']);