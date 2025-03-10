<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RestaurantDashboardController extends Controller
{
    public function index($viewType = 'restaurant.dashboard')
    {
        //make sure kalo data yang masuk cuma data restoran itu
        $restaurant = Auth::guard('restaurant')->user();

        if (!$restaurant) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil produk berdasarkan restoran
        $products = DB::table('products')->where('restaurant_id', $restaurant->id)->get();

        // Menghitung Total Donation dari atribut 'total' di tabel carts
        $totalDonation = DB::table('order_items')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->where('orders.restaurant_id', $restaurant->id)
        ->SUM('orders.total');

        // Menghitung Total Orders dari jumlah data di tabel carts
        $totalOrders = DB::table('order_items')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->where('orders.restaurant_id', $restaurant->id)
        ->count();

        // Menghitung Total Portion Donate dari atribut 'quantity' di tabel cart_items
        $totalPortions = DB::table('order_items')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->where('orders.restaurant_id', $restaurant->id)
        ->SUM('order_items.quantity');

        // Mengambil 5 pesanan terbaru dengan detail makanan
        $recentOrders = DB::table('orders')
        ->select('orders.id', 'orders.total', 'orders.status', 'orders.created_at')
        ->addSelect(DB::raw("
            GROUP_CONCAT(CONCAT(order_items.quantity, ' ', products.name) SEPARATOR ', ') AS transaction_detail
        "))
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->where('products.restaurant_id', $restaurant->id)
        ->groupBy('orders.id', 'orders.total', 'orders.status', 'orders.created_at')
        ->orderBy('orders.created_at', 'desc')
        ->take(5)
        ->get();

        $allOrders = DB::table('orders')
            ->select('orders.id', 'orders.total', 'orders.status', 'orders.created_at')
            ->addSelect(DB::raw("
                GROUP_CONCAT(CONCAT(order_items.quantity, ' ', products.name) SEPARATOR ', ') AS transaction_detail
            "))
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('products.restaurant_id', $restaurant->id)
            ->groupBy('orders.id', 'orders.total', 'orders.status', 'orders.created_at')
            ->orderBy('orders.created_at', 'asc')
            ->get();

        $view = ($viewType === 'orderlist') ? 'OrderListRestaurant' : 'restaurant.dashboard';

        return view($view, [
            'restaurant' => $restaurant,
            'products' => $products,
            'totalDonation' => $totalDonation,
            'totalOrders' => $totalOrders,
            'totalPortions' => $totalPortions,
            'recentOrders' => $recentOrders,
            'allOrders' => $allOrders
        ]);
    }
}
