<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LocationController extends Controller
{
    // Menampilkan halaman lokasi
    public function index()
    {
        $city = Restaurant::all();

        return view('restoranpage',compact('city')); // Pastikan ada file location.blade.php di resources/views
    }

    public function list(Request $request)
    {
        $resto = Restaurant::all();
        // dd($resto);
        $selectedCity = $request->query('city'); // Ambil nama kota dari query string

        // Ambil daftar restoran berdasarkan kota yang dipilih
        $filteredResto = $selectedCity ? Restaurant::where('city', $selectedCity)->get() : collect();

        return view('location', compact('resto', 'filteredResto', 'selectedCity'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Ambil hanya kota unik yang mengandung query (tanpa duplikasi)
        $locations = DB::table('restaurants')
            ->where('city', 'LIKE', "%$query%")
            ->distinct()
            ->pluck('city'); 

        \Log::info('Hasil Query:', $locations->toArray()); // Debugging ke log

        return response()->json($locations);
    }

}