<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Service\ProductsService;
use Illuminate\Support\Facades\Route;

// Public Routes

// Register and Login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Search Methods
Route::prefix('products')->group(function () {

    // Simple Search
    Route::get('/', [ProductController::class, 'index']);
    Route::get('{id}', [ProductController::class, 'show']);

    // Search Name and Category
    Route::prefix('search')->group(function () {
        Route::get('{category}', [ProductController::class, 'searchByCategory']);
        Route::get('{name}/{category}', [ProductController::class, 'searchByNameAndCategory']);
    });

    // Search Product with ot without Images
    Route::prefix('sprite')->group(function () {
        Route::get('no_image_url', [ProductController::class, 'searchByNoImage']);
        Route::get('image_url', [ProductController::class, 'searchByImage']);
    });
});



// Protected Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
