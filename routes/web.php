<?php

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrphanageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RestaurantDashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DonationController;

Route::get('/api/restaurants', [RestaurantController::class, 'index']);

// use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('welcome');
// });

// use App\Http\Controllers\Auth\RegisteredOrphanageController;
// Route::post('/panti', [RegisteredOrphanageController::class, 'store'])->name('orphanage.add');
require __DIR__ . '/auth_orphanage.php';

Route::get('/panti', [OrphanageController::class, 'index'])->name('panti.index'); // Orphanage list

Route::get('/updateorphanage/{id}', [OrphanageController::class, 'edit'])->name('panti.edit'); // Orphanage edit form

Route::put('/updateorphanage/{id}', [OrphanageController::class, 'update'])->name('panti.update'); // Orphanage update

Route::post('/panti', [OrphanageController::class, 'store'])->name('panti.store'); // Store orphanage

Route::delete('/deleteorphanage/{id}', [OrphanageController::class, 'destroy'])->name('panti.destroy'); // Delete orphanage


Route::get('/profilee', function () {
    return view('profile');
});

// Route::get('/my-donations', function () {
//     return view('mydonations');
// });

Route::get('/payment', function () {
    return view('payment');
});


Route::get('/OrderList', function () {
    return view('OrderList');
});

Route::get('/OrderListRestaurant', function () {
    return view('OrderListRestaurant');
});
// Route::get('/restoranpage', [LocationController::class, 'index']);

// In routes/web.php
Route::delete('/restaurant/{id}', [RestaurantController::class, 'destroy'])->name('restaurant.delete');

Route::put('/restaurant/{id}/update', [RestaurantController::class, 'update'])->name('restaurant.update');

Route::get('/location', [LocationController::class, 'list'])->name('resto.list');

Route::get('/contact-us', function () {
    return view('contactus');
})->name('contactus');

Route::get('/updateuserinfo', function () {
    return view('updateuserpage');
});

Route::get('/userinfo', function () {
    return view('userinfopage');
});

Route::get('/restaurantinfo', [RestaurantController::class, 'index'])->name('restaurantinfo');

Route::get('/updaterestaurantinfo/{id}', [RestaurantController::class, 'edit'])->name('restaurant.edit');

Route::get('/updateorphanageinfo', function () {
    return view('updateOrphanage');
});

Route::get('/productinfo', function () {
    return view('restorantproductinfo');
});

Route::get('/updaterestorant', function () {
    return view('updaterestorantproduct');
});

Route::get('/supportAdmin', function () {
    return view('support');
});

use App\Http\Controllers\ProfileController;

// Rute utama untuk user biasa
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    // Route::post('/cart/switch', [CartController::class, 'switchRestaurant']);
    // Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity']);

    // Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    // Route::post('/cart/switch', [CartController::class, 'switchRestaurant'])->name('cart.switch');
    // Route::get('/cart/details', [CartController::class, 'cartDetails'])->name('cart.details');
    // Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');

    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{itemId}', [CartController::class, 'updateCartItem'])->name('cart.update');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'removeCartItem'])->name('cart.remove');

    Route::post('/update-cart', [CartController::class, 'updateCart']);
    Route::post('/clear-cart', [CartController::class, 'clearCart']);

    Route::get('/cart', [CartController::class, 'showCart'])->name('cart');

    Route::post('/checkout', [CheckoutController::class, 'checkout']);

    Route::get('/my-donations', [DonationController::class, 'getDonations'])->name('mydonations');
});
Route::post('/midtrans/notification', [CheckoutController::class, 'handleNotification']);

Route::get('/admin', function () {
    return view('welcomeadmin');
})->name('admin');

Route::get('/restaurant', function () {
    return view('welcomerestaurant');
})->name('restaurant');

require __DIR__ . '/auth.php';
// Include rute authentication admin & restaurant
require __DIR__ . '/auth_admin.php';
require __DIR__ . '/auth_restaurant.php';

Route::get('/signin', function () {
    return view('signin');
})->name('signin');

// Route::get('/dashboardAdmin', function () {
//     return view('dashboardAdmin');
// })->name('dashboardAdmin');

// Route::get('/dashboardResto', function () {
//     return view('dashboardResto');
// })->name('dashboardResto');

use App\Http\Controllers\SupportController;

Route::post('/contactus', [SupportController::class, 'store'])->name('contactus');
Route::post('/update-handled/{id}', [SupportController::class, 'updateHandled']);

use App\Models\Support;

Route::get('/support', [SupportController::class, 'index'])->name('support.index');

Route::post('/add-restaurant', [RestaurantController::class, 'store'])->name('restaurant.store');

Route::get('/menupage', [RestaurantController::class, 'menu'])->name('menupage');

Route::get('/menu', [RestaurantController::class, 'menu'])->name('menu');

Route::get('/restoranpage', [ProductController::class, 'restoran'])->name('restoranpage.restoran');

Route::get('/search-location', [LocationController::class, 'search']);

Route::get('/dashboard/resto', [RestaurantDashboardController::class, 'index'])->name('dashboardResto');



// Route untuk dashboard admin (dengan middleware auth biar hanya user login yang bisa akses)
// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('DashboardAdmin');
//     // Route::get('/admin/orderlist', [AdminDashboardController::class, 'list'])->name('tesdashboardadmin');
// });

// Route::get('/admin/orderlist', [AdminDashboardController::class, 'list'])->name('tesdashboardadmin');

use Midtrans\Snap;
use Midtrans\Transaction;

// Route::post('/checkout', function (Request $request) {
//     $order_id = 'ORDER-' . uniqid();
//     $total = $request->total; // Total dari cart

//     $params = [
//         'transaction_details' => [
//             'order_id' => $order_id,
//             'gross_amount' => $total,
//         ],
//     ];

//     $snapToken = Snap::getSnapToken($params);

//     return response()->json(['snapToken' => $snapToken]);
// });
