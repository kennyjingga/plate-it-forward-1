<?php
use App\Http\Controllers\RestaurantController;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/restaurants', 'App\Http\Controllers\RestaurantController@index');

Route::get('/restaurants', [RestaurantController::class, 'index']);

