<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['guest']], function () {
    Route::resource('guest', GuestController::class);
});


Route::group(['middleware' => ['auth']], function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('image-gallery', ImageGalleryController::class);
});
