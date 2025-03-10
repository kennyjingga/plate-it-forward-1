<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function getDonations()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $donationCount = DB::table('orders')
        ->where('user_id', $user->id)
        ->count();

        // Ambil data orders dengan join ke restaurants & orphanages
        $donations = DB::table('orders')
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->join('orphanages', 'orders.orphanage_id', '=', 'orphanages.id')
            ->select(
                'orders.created_at',
                'restaurants.name as restaurant_name',
                'orphanages.name as orphanage_name',
                'orders.total',
                'orders.status',
                'orders.id',
            )
            ->where('user_id', $user->id)      
            ->orderBy('orders.created_at', 'desc')
            ->get();

        // Ambil detail transaksi dari order_items
        $orderItems = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('order_id', DB::raw("GROUP_CONCAT(CONCAT(quantity, ' ', products.name) SEPARATOR ', ') as transaction_detail"))
            ->groupBy('order_id')
            ->get()
            ->keyBy('order_id');

        // Gabungkan orderItems ke donations
        foreach ($donations as $donation) {
            $donation->transaction_detail = $orderItems[$donation->id]->transaction_detail ?? '-';
            $donation->formatted_date = Carbon::parse($donation->created_at)->format('l, d M Y');
            $donation->formatted_price = 'IDR ' . number_format($donation->total, 0, ',', '.');
        }

        return view('mydonations', compact('donations', 'donationCount'));
    }
}