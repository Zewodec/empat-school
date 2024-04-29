<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('/auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::get('/me', 'me')->name('me')->middleware('auth:sanctum');
});

Route::prefix('/categories')->name('categories.')->controller(CategoryController::class)->group(function () {
    Route::get('/', 'allCategories')->name('index')->middleware('auth:sanctum');
    Route::post('/addCategory', 'addCategory')->name('addCategory')->middleware('auth:sanctum');

    Route::get('/{category}', 'showCategory')->name('show')->middleware('auth:sanctum');
    Route::patch('/{category}', 'patchCategory')->name('patchCategory')->middleware('auth:sanctum');

    Route::prefix('/{category}/products')->name('products.')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('auth:sanctum');
        Route::post('/addProduct', 'addProduct')->name('addProduct')->middleware('auth:sanctum');

        Route::get('/{product}', 'show')->name('show')->middleware('auth:sanctum');
        Route::patch('/{product}', 'patchProduct')->name('patchProduct')->middleware('auth:sanctum');
    });
});
