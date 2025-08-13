<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Storefront\CartController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Storefront\ProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Storefront\CategoryController;
use App\Http\Controllers\Storefront\CheckoutController;
use App\Http\Controllers\Admin\AdminProductVariantController;
use App\Http\Controllers\Storefront\ProductVariantController;

Route::get('/', function () {
    return view('welcome');
});

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [AuthController::class, 'reset']);

Route::get('store/products', [ProductController::class, 'index']);
Route::post('store/products', [ProductController::class, 'show']);

Route::middleware('auth:api')->group(function () {

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{slug}', [CategoryController::class, 'show']);

    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{slug}', [ProductController::class, 'show']);

    // Product Variants
    Route::get('/products/{slug}/variants', [ProductVariantController::class, 'index']);
    Route::get('/products/{slug}/variants/{id}', [ProductVariantController::class, 'show']);

    // Cart
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::post('/cart/remove', [CartController::class, 'remove']);
    Route::post('/cart/update', [CartController::class, 'update']);

    // Checkout
    Route::post('/checkout', [CheckoutController::class, 'process']);

    Route::middleware('role:Super Admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::post('/', [UserController::class, 'index']);
            Route::post('store', [UserController::class, 'store']);
            Route::post('show', [UserController::class, 'show']);
            Route::post('update', [UserController::class, 'update']);
            Route::post('delete', [UserController::class, 'delete']);
        });

        // Permission management routes
        Route::prefix('permissions')->group(function () {
            Route::post('/', [PermissionController::class, 'index']);
            Route::post('store', [PermissionController::class, 'store']);
            Route::post('show', [PermissionController::class, 'show']);
            Route::post('update', [PermissionController::class, 'update']);
            Route::post('delete', [PermissionController::class, 'delete']);
        });

        // Role management routes
        Route::prefix('roles')->group(function () {
            Route::post('/', [RoleController::class, 'index']);
            Route::post('store', [RoleController::class, 'store']);
            Route::post('show', [RoleController::class, 'show']);
            Route::post('update', [RoleController::class, 'update']);
            Route::post('delete', [RoleController::class, 'delete']);
        });

        // Categories Management
        Route::get('/categories', [AdminCategoryController::class, 'index']);
        Route::post('/categories', [AdminCategoryController::class, 'store']);
        Route::get('/categories/{id}', [AdminCategoryController::class, 'show']);
        Route::post('/categories/{id}', [AdminCategoryController::class, 'update']);
        Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy']);

        // Products Management
        Route::get('/products', [AdminProductController::class, 'index']);
        Route::post('/products', [AdminProductController::class, 'store']);
        Route::get('/products/{id}', [AdminProductController::class, 'show']);
        Route::post('/products/{id}', [AdminProductController::class, 'update']);
        Route::delete('/products/{id}', [AdminProductController::class, 'destroy']);

        // Product Variants Management
        Route::get('/products/{product_id}/variants', [AdminProductVariantController::class, 'index']);
        Route::post('/products/{product_id}/variants', [AdminProductVariantController::class, 'store']);
        Route::get('/products/{product_id}/variants/{id}', [AdminProductVariantController::class, 'show']);
        Route::post('/products/{product_id}/variants/{id}', [AdminProductVariantController::class, 'update']);
        Route::delete('/products/{product_id}/variants/{id}', [AdminProductVariantController::class, 'destroy']);

        // Orders Management
        Route::get('/orders', [AdminOrderController::class, 'index']);
        Route::get('/orders/{id}', [AdminOrderController::class, 'show']);
        Route::post('/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus']);
    });

});
