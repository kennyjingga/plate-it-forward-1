<?php

use App\Http\Controllers\AdminPasswordController;
use App\Http\Controllers\Auth\RegisteredAdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisteredAdminController::class, 'create'])->name('register');
    Route::post('register', [RegisteredAdminController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('forgot-password', [AdminPasswordController::class, 'showForgotForm'])->name('forgot');
    Route::post('forgot-password', [AdminPasswordController::class, 'sendResetLink']);
    Route::get('reset-password/{token}', [AdminPasswordController::class, 'showResetForm'])->name('reset');
    Route::post('reset-password', [AdminPasswordController::class, 'resetPassword'])->name('reset-submit');

    Route::middleware(['admin'])->group(function () {
        // Route::get('dashboard', function () {
        //     return view('admin.dashboard');
        // })->name('dashboard');
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/products', [ProductController::class, 'index']);
        Route::match(['get', 'post'], 'orderlist', [AdminDashboardController::class, 'list'])->name('OrderList');
    });
});
