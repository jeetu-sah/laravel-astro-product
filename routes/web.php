<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\ProductVarientController;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['guest']], function () {
    Route::resource('guest', GuestController::class);
});


Route::group(['middleware' => ['auth']], function () {

    Route::resource('dashboard', DashboardController::class);
    Route::get('logout', [DashboardController::class, 'logout']);

    Route::group(['prefix' => 'catalog', 'as' => 'catalog.'], function () {
        // Category Route start
        Route::get('category/agaxList', [CategoryController::class, 'list']);
        Route::resource('category', CategoryController::class);

        // Product Route start
        Route::get('product/agaxList', [ProductController::class, 'list']);
        Route::delete('product/{productId}/delete-image/{productImageId}', [ProductController::class, 'removeImage']);
        Route::match(['get', 'post'], 'product/{productId}/upload-image', [ProductController::class, 'uploadImage']);
        Route::post('product/{id}/product-details', [ProductController::class, 'editProductDetails'])->name('product.product_details');
        Route::post('product/{id}/seo', [ProductController::class, 'storeSeo'])->name('product.seo');
        Route::resource('product', ProductController::class);

        //products varient start
        Route::group(['prefix' => '{productId}/product-varient', 'as' => 'product-varient.'], function () {
            Route::get('/agaxList', [ProductVarientController::class, 'list'])->name('agaxList');
            Route::resource('', ProductVarientController::class);
        });
    });

    Route::group(['prefix' => 'attributes', 'as' => 'attributes.'], function () {
        // Attributes Route start
        Route::get('/{id}/edit', [AttributeController::class, 'edit']);
        Route::resource('/', AttributeController::class);
        Route::get('/ajaxlist', [AttributeController::class, 'list']);


        Route::group(['prefix' => '/{attributeId}/attributes-values', 'as' => 'attributes-values.'], function () {
            Route::resource('', AttributeValueController::class);
        });
    });

    Route::group(['prefix' => 'image-gallery', 'as' => 'image-gallery.'], function () {
        // Attributes Route start
        // Route::get('/', [AttributeController::class, 'edit']);
        Route::resource('', ImageGalleryController::class);
        Route::get('/map-images', [ImageGalleryController::class, 'mapImages'])->name('map-images');
        Route::get('/mapped-images-to', [ImageGalleryController::class, 'mappedImagesTo'])->name('mapped-images-to');

        Route::post('/{id}/upload-image', [ProductVarientController::class, 'uploadImage'])->name('product-varient.upload-image');
    });

    // Route::resource('image-gallery', ImageGalleryController::class);
});
