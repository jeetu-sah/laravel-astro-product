<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['guest']], function () {
    Route::resource('guest', GuestController::class);
});


Route::group(['middleware' => ['auth']], function () {
    Route::resource('dashboard', DashboardController::class);
    // Category Route start
    Route::get('category/agaxList', [CategoryController::class, 'list']);
    Route::resource('category', CategoryController::class);

    // Product Route start
    Route::get('product/agaxList', [ProductController::class, 'list']);
    Route::get('product/{productId}/upload-image', [ProductController::class, 'uploadImage']);
    Route::resource('product', ProductController::class);

    Route::resource('image-gallery', ImageGalleryController::class);
});
