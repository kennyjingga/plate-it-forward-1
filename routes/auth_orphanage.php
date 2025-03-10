<?php

use App\Http\Controllers\Auth\RegisteredOrphanageController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::post('/panti', [RegisteredOrphanageController::class, 'store'])->name('panti.store');