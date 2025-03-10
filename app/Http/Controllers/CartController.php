<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Products;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function updateCart(Request $request)
    {
        $user_id = Auth::id();
        $product_id = $request->product_id;
        $quantity = $request->quantity;

        $cart = Cart::firstOrCreate(['user_id' => $user_id]);

        // Cek apakah produk dari restoran yang berbeda
        $product = Products::find($product_id);
        $cartItem = CartItem::where('cart_id', $cart->id)->first();

        if ($cartItem && $cartItem->product->restaurant_id !== $product->restaurant_id) {
            return response()->json(['error' => 'Restoran berbeda'], 400);
        }

        if ($quantity > 0) {
            CartItem::updateOrCreate(
                ['cart_id' => $cart->id, 'product_id' => $product_id],
                ['quantity' => $quantity, 'price' => $product->price, 'subtotal' => $quantity * $product->price]
            );
        } else {
            CartItem::where('cart_id', $cart->id)->where('product_id', $product_id)->delete();
        }

        return response()->json(['success' => true]);
    }

    public function clearCart()
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->first();

        if ($cart) {
            CartItem::where('cart_id', $cart->id)->delete();
            $cart->delete();
        }

        return response()->json(['success' => true]);
    }


    public function addToCart(Request $request, $productId)
    {
        $user = Auth::user();
        $product = Products::findOrFail($productId);

        // Cek apakah ada cart aktif
        $cart = Cart::where('user_id', $user->id)->first();

        // Jika belum ada cart, buat baru
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'total' => 0
            ]);
        } else {
            // Cek apakah cart memiliki produk dari restoran lain
            $existingRestaurantId = $cart->items->first()?->product?->restaurant_id;
            if ($existingRestaurantId && $existingRestaurantId !== $product->restaurant_id) {
                return response()->json(['switchRestaurant' => true]);
            }
        }

        // Cek apakah produk sudah ada di cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
            $cartItem->subtotal = $cartItem->quantity * $cartItem->price;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'subtotal' => $product->price
            ]);
        }

        // Update total cart
        $cart->total = $cart->items->sum('subtotal');
        $cart->save();

        return response()->json(['success' => true]);
    }

    public function showCart()
    {
        $userId = Auth::id();

        // Ambil data cart berdasarkan user
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            return view('cart', compact('cart'));
        }

        // Ambil semua item dalam cart
        $cartItems = CartItem::where('cart_id', $cart->id)
            ->with('product') // Pastikan relasi ke Product ada
            ->get();

        $firstCartItem = $cartItems->first();
        $restaurantId = $firstCartItem && $firstCartItem->product ? $firstCartItem->product->restaurant_id : null;
        $restaurant = Restaurant::find($restaurantId);


        // Hitung subtotal
        $subtotal = $cartItems->sum('subtotal');

        // Biaya tetap
        $serviceFee = $subtotal * 0.05;
        $total = $subtotal + $serviceFee;

        // Simpan total ke dalam tabel cart
        $cart->update([
            'total' => $total
        ]);

        return view('cart', compact('cart', 'cartItems', 'restaurant', 'restaurantId', 'subtotal',  'serviceFee', 'total'));
    }

    public function switchRestaurant(Request $request)
    {
        $user = Auth::user();
        Cart::where('user_id', $user->id)->delete(); // Hapus cart lama

        return response()->json(['cleared' => true]);
    }

    public function updateQuantity(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true]);
    }
}
