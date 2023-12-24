<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\OrderController;
use App\Models\ProductModel;

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

    //Cart
    Route::post('order', [OrderController::class, 'checkout']);

    // Add Product
    Route::post('addproduct', [ProductController::class, 'addproduct']);

    Route::get('product/{id}/image', function ($id) {
        $product = ProductModel::where('product_id', $id)->first();

        if (!$product) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $imagePath = $product->image_filepath;
        return response()->file(public_path($imagePath));
    });
});

//Register
Route::post('register', [AuthController::class, 'register']);

//Login
Route::post('login', [AuthController::class, 'login']);

// Products
Route::get('products', [ProductController::class, 'products']);

