<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Products;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class RestaurantController extends Controller
{
    // public function index()
    // {
    //     return response()->json(Restaurant::all());
    // }
    public function index()
    {
        $restaurants = Restaurant::all(); // Ambil semua data dari tabel supports
        return view('restaurantinfopage', compact('restaurants'));
    }

    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.show', compact('restaurant'));
    }

    public function edit($id)
    {
        $restaurant = Restaurant::find($id);

        if (!$restaurant) {
            return redirect()->route('restaurantinfo')->with('error', 'Restaurant not found');
        }

        return view('updaterestaurantpage', compact('restaurant'));
    }

    public function showRestaurantsByCity($city)
    {
        $restaurants = Restaurant::where('city', $city)->get();
        return view('restaurants.location', compact('restaurants', 'city'));
    }


    // public function update(Request $request, $id)
    // {
    //     $restaurant = Restaurant::findOrFail($id);
    //     $restaurant->update($request->all());
    //     return redirect()->route('restaurants.index')->with('success', 'Restaurant updated successfully!');
    // }
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:restaurants,email,' . $id,
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ]);

        // Find the restaurant by ID
        $restaurant = Restaurant::findOrFail($id);

        // Update the restaurant with the new values
        $restaurant->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'contact' => $request->contact,
        ]);

        // Redirect back to the restaurant info page with a success message
        return redirect()->route('restaurantinfo')->with('success', 'Restaurant updated successfully!');
    }



    public function destroy($id)
    {
        // Find the restaurant by ID
        $restaurant = Restaurant::findOrFail($id);
        // Delete the restaurant
        $restaurant->delete();
        // Redirect back to the restaurant list with a success message
        return redirect()->route('restaurantinfo')->with('success', 'Restaurant deleted successfully!');
    }

    // public function menu(Request $request)
    // {
    //     $id = $request->query('id'); // Ambil ID dari URL
    //     $restsearch = Restaurant::findOrFail($id); // Cari restoran berdasarkan ID
    //     $products = Products::where('restaurant_id', $id)->get(); // Ambil semua produk restoran

    //     $carts = null;

    //     if (Auth::check()) {

    //         $user_id = Auth::id();
    //         $carts = Cart::where('user_id', $user_id)->with('items.product')->first();
    //     }
    //     // dd($carts);

    //     return view('menupage', compact('restsearch', 'products', 'carts'));
    // }
    public function menu(Request $request)
    {
        $id = $request->query('id'); // Ambil ID dari URL
        $restsearch = Restaurant::findOrFail($id); // Cari restoran berdasarkan ID

        // Ambil semua produk restoran dengan stok dari product_exps
        $products = Products::where('restaurant_id', $id)
            ->withSum('productExps', 'quantity')
            ->having('product_exps_sum_quantity', '>', 0) // Hanya ambil produk dengan stok > 0
            ->get();

        $carts = null;
        $cartItems = [];

        if (Auth::check()) {
            $user_id = Auth::id();
            $carts = Cart::where('user_id', $user_id)->with('items.product')->first();

            // Ambil quantity produk dalam cart
            $cartItems = DB::table('cart_items')
                ->join('carts', 'cart_items.cart_id', '=', 'carts.id')
                ->where('carts.user_id', $user_id)
                ->pluck('cart_items.quantity', 'cart_items.product_id');
        }

        return view('menu', compact('restsearch', 'products', 'carts', 'cartItems'));
    }
}
