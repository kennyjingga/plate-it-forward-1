<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // make sure kalo data yang masuk cuma data restoran itu
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Top Donors: Total donasi berdasarkan user
        $topDonors = DB::table('orders')
            ->select('user_id', DB::raw('SUM(total) as total_donation'))
            ->groupBy('user_id')
            ->orderByDesc('total_donation')
            ->limit(5)
            ->get();

        // Ambil nama user
        foreach ($topDonors as $donor) {
            $donor->name = DB::table('users')->where('id', $donor->user_id)->value('name');
        }

        // Top Restaurant: Total quantity berdasarkan restoran
        $topRestaurants = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id') // Join ke tabel orders
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id') // Join ke tabel restaurants
            ->select('restaurants.id', 'restaurants.name', DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->groupBy('restaurants.id', 'restaurants.name') // Group by pakai ID dan Name
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        // Ambil nama restoran
        foreach ($topRestaurants as $restaurant) {
            $restaurant->name = DB::table('restaurants')->where('id', $restaurant->id)->value('name');
        }

        // Most Donated Orphanages: Total donasi berdasarkan panti asuhan
        $topOrphanages = DB::table('orphanages')
            ->select('id', 'name', DB::raw('SUM(donation) as total_donation'))
            ->groupBy('id', 'name')
            ->orderByDesc('total_donation')
            ->limit(5)
            ->get();

        // Total user
        $totalUsers = DB::table('users')->count();

        // Total restoran
        $totalRestaurants = DB::table('restaurants')->count();

        // Total panti asuhan
        $totalOrphanages = DB::table('orphanages')->count();

        // Total donasi
        $totalDonation = DB::table('orders')->sum('total');

        return view('admin.dashboard', compact(

            'topDonors',
            'topRestaurants',
            'topOrphanages',
            'totalUsers',
            'totalRestaurants',
            'totalOrphanages',
            'totalDonation'
        ));
    }

    // public function list(Request $request)
    // {
    //     $admin = Auth::guard('admin')->user();

    //     // Memeriksa apakah admin terautentikasi
    //     if (!$admin) {
    //         return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    //     }

    //     // Memeriksa jika ada data order_id dan status di request
    //     if ($request->isMethod('POST') && $request->has('order_id') && $request->has('status')) {
    //         // Mendapatkan data dari request
    //         $orderId = $request->order_id;
    //         $newStatus = $request->status;

    //         // Validasi status yang diterima
    //         $validStatuses = ['Paid', 'Completed', 'On Process'];
    //         if (!in_array($newStatus, $validStatuses)) {
    //             return response()->json(['error' => 'Status tidak valid.'], 400);
    //         }

    //         // Memperbarui status pesanan di database
    //         $update = DB::table('orders')
    //             ->where('id', $orderId) // Memilih pesanan berdasarkan ID
    //             ->update(['status' => $newStatus]); // Memperbarui status pesanan
    //     }

    //     // Ambil semua data pesanan jika tidak ada permintaan untuk memperbarui status
    //     $allOrders = DB::table('orders')
    //         ->select('orders.id', 'orders.total', 'orders.status', 'orders.created_at')
    //         ->addSelect(DB::raw("
    //             GROUP_CONCAT(CONCAT(order_items.quantity, ' ', products.name) SEPARATOR ', ') AS transaction_detail
    //         "))
    //         ->join('order_items', 'orders.id', '=', 'order_items.order_id')
    //         ->join('products', 'order_items.product_id', '=', 'products.id')
    //         ->groupBy('orders.id', 'orders.total', 'orders.status', 'orders.created_at')
    //         ->orderBy('orders.created_at', 'asc')
    //         ->get();

    //     return view('orderlist', compact('allOrders'));
    // }
    public function list(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Memeriksa apakah admin terautentikasi
        if (!$admin) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Memeriksa apakah request menggunakan AJAX dan ada data yang valid
        if ($request->isMethod('POST') && $request->has('order_id') && $request->has('status')) {
            // Mendapatkan data dari request
            $orderId = $request->order_id;
            $newStatus = $request->status;

            // Validasi status yang diterima
            $validStatuses = ['Paid', 'Completed', 'On Process'];
            if (!in_array($newStatus, $validStatuses)) {
                return response()->json(['error' => 'Status tidak valid.'], 400);
            }

            // Memperbarui status pesanan di database
            $update = DB::table('orders')
                ->where('id', $orderId) // Memilih pesanan berdasarkan ID
                ->update(['status' => $newStatus]); // Memperbarui status pesanan

            // Jika update berhasil, kembalikan response JSON sukses
            if ($update) {
                return response()->json(['success' => 'Status berhasil diperbarui.']);
            } else {
                return response()->json(['error' => 'Gagal memperbarui status.'], 400);
            }
        }

        // Ambil semua data pesanan jika tidak ada permintaan untuk memperbarui status
        $allOrders = DB::table('orders')
            ->select('orders.id', 'orders.total', 'orders.status', 'orders.created_at')
            ->addSelect(DB::raw("
            GROUP_CONCAT(CONCAT(order_items.quantity, ' ', products.name) SEPARATOR ', ') AS transaction_detail
        "))
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->groupBy('orders.id', 'orders.total', 'orders.status', 'orders.created_at')
            ->orderBy('orders.created_at', 'asc')
            ->get();

        return view('orderlist', compact('allOrders'));
    }
}
