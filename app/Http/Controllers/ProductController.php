<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\productsexp;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;


class ProductController extends Controller
{
    public function index()
    {
        // Ambil ID restoran yang sedang login
        $restaurantId = Auth::guard('restaurant')->user()->id;

        // Ambil hanya produk yang dimiliki restoran ini
        $products = Products::where('restaurant_id', $restaurantId)->get();

        return view('restorantproductinfo', compact('products'));
    }


    public function menuPage()
    {
        $product = Products::find(1); // Ambil data dengan ID = 1
        return view('menupage', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'nullable|string',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $restaurantId = Auth::guard('restaurant')->user()->id;

    // Simpan gambar ke folder storage/app/public/products
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('products', 'public');
    } else {
        $fotoPath = 'products/noimage.png'; // Pastikan noimage.png ada di storage/app/public/products/
    }

    Products::create([
        'restaurant_id' => $restaurantId,
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'foto' => $fotoPath,
    ]);

    return redirect()->route('products')->with('success', 'Produk berhasil ditambahkan.');
}
        


    public function createproduct()
    {
        return view('addproduct');
    }

    public function restoran()
    {
        $now = Carbon::today();

        $flashSaleProducts = DB::table('productexps as pe1')
            ->join('products', 'pe1.product_id', '=', 'products.id')
            ->select(
                'products.name',
                'pe1.price_discount',
                'pe1.quantity',
                'pe1.expired_at'
            )
            ->whereDate('pe1.expired_at', '>=', Carbon::today())
            ->whereRaw("
            pe1.expired_at = (
                SELECT MIN(pe2.expired_at)
                FROM productexps AS pe2
                WHERE pe2.product_id = pe1.product_id
            )
        ")
            ->orderBy('pe1.expired_at', 'asc')
            ->orderBy('pe1.quantity', 'desc')
            ->limit(10)
            ->get();

        $recommendedRestaurants = DB::table('restaurants')
            ->join('products', 'restaurants.id', '=', 'products.restaurant_id')
            ->join('productexps', 'products.id', '=', 'productexps.product_id')
            ->select('restaurants.id', 'restaurants.name', DB::raw('SUM(productexps.quantity) as total_stock'))
            ->groupBy('restaurants.id', 'restaurants.name')
            ->orderByDesc('total_stock')
            ->limit(6)
            ->get();

        $city = Restaurant::all();

        return view('restoranpage', compact('flashSaleProducts', 'city', 'recommendedRestaurants'));
    }


    public function delete(Request $request)
{
    $productIds = $request->input('products');

    if ($productIds) {
        Products::whereIn('id', $productIds)->delete();
        return redirect()->back()->with('success', 'Produk yang dipilih berhasil dihapus.');
    }

    return redirect()->back()->with('error', 'Tidak ada produk yang dipilih.');
}

public function edit($id)
{
    $product = Products::findOrFail($id);
    return view('updaterestorantproduct', compact('product'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = Products::findOrFail($id);
    
    // Update data
    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;

    // Update foto jika ada
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('products', 'public');
        $product->foto = $fotoPath;
    }

    $product->save();

    return redirect()->route('products')->with('success', 'Produk berhasil diperbarui!');
}


}

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Products;

// class ProductController extends Controller
// {
//     public function index()
//     {
//         $products = Products::all();
//         return view('products.index', compact('products'));
//     }


//     public function menuPage()
//     {
//         $product = Products::find(1); // Ambil data dengan ID = 1
//         return view('menupage', compact('product'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required',
//             'price' => 'required|integer',
//             'description' => 'nullable|string',
//             'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);

//         $restaurantId = Auth::guard('restaurant')->user()->id;

//         Products::create([
//             'restaurant_id' => $restaurantId,
//             'name' => $request->name,
//             'price' => $request->price,
//             'description' => $request->description,
//             'foto' => $request->foto ? $request->file('foto')->store('products') : 'noimage.png',
//         ]);

//         return redirect()->route('products')->with('success', 'Produk berhasil ditambahkan.');
//     }

//     public function createproduct()
//     {
//         return view('addproduct');
//     }
