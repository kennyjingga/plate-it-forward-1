<?php

use App\Http\Controllers\Auth\RegisteredRestaurantController;
use App\Http\Controllers\RestaurantPasswordController;
use App\Http\Controllers\RestaurantDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsexpsController;

Route::prefix('restaurant')->name('restaurant.')->group(function () {
    Route::get('register', [RegisteredRestaurantController::class, 'create'])->name('register');
    Route::post('register', [RegisteredRestaurantController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


    Route::get('forgot-password', [RestaurantPasswordController::class, 'showForgotForm'])->name('forgot');
    Route::post('forgot-password', [RestaurantPasswordController::class, 'sendResetLink']);
    Route::get('reset-password/{token}', [RestaurantPasswordController::class, 'showResetForm'])->name('reset');
    Route::post('reset-password', [RestaurantPasswordController::class, 'resetPassword'])->name('reset-submit');

    Route::middleware(['restaurant'])->group(function () {
        // Route::get('dashboard', function () {
        //     return view('restaurant.dashboard');
        // })->name('dashboard');
        Route::get('dashboard', [RestaurantDashboardController::class, 'index'])->name('dashboard');
        // Route::get('/products',[ProductController::class, 'index'])->name('products');
    });


});

Route::get('/products', [ProductController::class, 'index'])->name('products')->middleware('auth:restaurant');


Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/delete', [ProductController::class, 'delete'])->name('products.delete');
Route::get('/addproduct', [ProductController::class, 'createproduct'])->name('products.create');
Route::post('/addproduct', [ProductController::class, 'store'])->name('products.store');



Route::get('/productexp/{id}', [ProductsexpsController::class, 'show'])->name('productexp.show');


Route::delete('/productexp/delete', [ProductsexpsController::class, 'destroy'])->name('productexp.delete');
Route::get('/productexp/{id}/edit', [ProductsexpsController::class, 'edit'])->name('productexp.edit');
Route::put('/productexp/{id}', [ProductsexpsController::class, 'update'])->name('productexp.update');
Route::delete('/productexp/delete-multiple', [ProductsexpsController::class, 'deleteMultiple'])->name('productexp.deleteMultiple');




Route::get('/dashboard/orderlist', [RestaurantDashboardController::class, 'index'])->name('OrderListRestaurant')->defaults('viewType', 'orderlist');

Route::get('/addproductexp/{product_id}', [ProductsexpsController::class, 'create'])->name('productexp.create');
Route::post('/productexp/store', [ProductsexpsController::class, 'store'])->name('productexp.store');

