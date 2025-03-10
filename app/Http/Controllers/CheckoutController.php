<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use App\Models\Orphanage;
use App\Models\ProductExp;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use Midtrans\Notification;



class CheckoutController extends Controller
{

    public function checkout(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'User is not authenticated'], 401);
            }

            $cart = Cart::where('user_id', $user->id)->first();

            if (!$cart) {
                return response()->json(['message' => 'Cart is empty'], 400);
            }

            $order_id = (string)$cart->id;
            $total = $cart->total; // Pastikan ini sesuai dengan tabel

            $params = [
                'transaction_details' => [
                    'order_id' => rand(),
                    'gross_amount' => $total,
                ],
            ];


            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return response()->json(['snapToken' => $snapToken]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $notification = $request->all(); // Ambil semua data notifikasi
        $transaction = $notification['transaction_status'] ?? null;
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();


        DB::beginTransaction();
        try {

            if (!$cart) {
                return response()->json(['message' => 'Cart not found'], 404);
            }

            if ($transaction == 'settlement' || $transaction == 'capture') {
                $restaurantId = CartItem::where('cart_id', $cart->id)
                    ->first()
                    ->product
                    ->restaurant_id;

                $orphanage = Orphanage::where('city', function ($query) use ($restaurantId) {
                    $query->select('city')->from('restaurants')->where('id', $restaurantId);
                })->orderBy('donation', 'asc')->first();

                $order = Order::create([
                    'user_id' => $cart->user_id,
                    'restaurant_id' => $restaurantId,
                    'orphanage_id' => $orphanage ? $orphanage->id : null,
                    'total' => $cart->total,
                    'status' => 'paid',
                ]);
                $cartItems = CartItem::where('cart_id', $cart->id)->get();

                foreach ($cartItems as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->price,
                        'subtotal' => $cartItem->subtotal,
                    ]);

                    $remainingQuantity = $cartItem->quantity; // Jumlah yang harus dikurangi dari stok

                    // Ambil productexps berdasarkan product_id dengan expired_at terdekat terlebih dahulu
                    $productExps = ProductExp::where('product_id', $cartItem->product_id)
                        ->orderBy('expired_at', 'asc')
                        ->get();

                    foreach ($productExps as $productExp) {
                        if ($remainingQuantity <= 0) {
                            break; // Jika semua sudah dikurangi, keluar dari loop
                        }

                        if ($productExp->quantity >= $remainingQuantity) {
                            // Jika stok cukup, kurangi quantity
                            $productExp->update(['quantity' => $productExp->quantity - $remainingQuantity]);
                            $remainingQuantity = 0;
                        } else {
                            // Jika stok kurang dari jumlah yang dibutuhkan, habiskan stok ini dan hapus
                            $remainingQuantity -= $productExp->quantity;
                            $productExp->delete();
                        }
                    }
                }


                CartItem::where('cart_id', $cart->id)->delete();
                $cart->delete();

                DB::commit();
                return response()->json(['message' => 'Order created successfully'], 200);
            } elseif ($transaction == 'expire' || $transaction == 'cancel') {
                DB::rollBack();
                return response()->json(['message' => 'Payment failed or expired'], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error processing order', 'error' => $e->getMessage()], 500);
        }
    }
    // public function handleNotification(Request $request)
    // {
    //     dd('handleNotification masuk!', $request->all());
    //     Config::$serverKey = config('services.midtrans.server_key');
    //     Config::$isProduction = config('services.midtrans.is_production');
    //     Config::$isSanitized = true;
    //     Config::$is3ds = true;

    //     $notification = new \Midtrans\Notification();
    //     $transaction = $notification->transaction_status;
    //     $orderId = $notification->order_id;

    //     DB::beginTransaction();
    //     try {
    //         $cart = Cart::find($orderId);
    //         $order = Order::where('order_id', $orderId)->first();
    //         $cart = Cart::where('user_id', $order->user_id)->first();

    //         if (!$cart) {
    //             return response()->json(['message' => 'Cart not found'], 404);
    //         }

    //         if ($transaction == 'settlement' || $transaction == 'capture') {
    //             $restaurantId = CartItem::where('cart_id', $cart->id)
    //                 ->first()
    //                 ->product
    //                 ->restaurant_id;

    //             $orphanage = Orphanage::where('city', function ($query) use ($restaurantId) {
    //                 $query->select('city')->from('restaurants')->where('id', $restaurantId);
    //             })->orderBy('donation', 'asc')->first();

    //             $order = Order::create([
    //                 'user_id' => $cart->user_id,
    //                 'restaurant_id' => $restaurantId,
    //                 'orphanage_id' => $orphanage ? $orphanage->id : null,
    //                 'total' => $cart->total,
    //                 'status' => 'paid',
    //             ]);

    //             foreach ($cart->cartItems as $cartItem) {
    //                 OrderItem::create([
    //                     'order_id' => $order->id,
    //                     'product_id' => $cartItem->product_id,
    //                     'quantity' => $cartItem->quantity,
    //                     'price' => $cartItem->price,
    //                     'subtotal' => $cartItem->subtotal,
    //                 ]);
    //             }

    //             $cart->cartItems()->delete();
    //             $cart->delete();

    //             DB::commit();
    //             return response()->json(['message' => 'Order created successfully'], 200);
    //         } elseif ($transaction == 'expire' || $transaction == 'cancel') {
    //             DB::rollBack();
    //             return response()->json(['message' => 'Payment failed or expired'], 400);
    //         }
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['message' => 'Error processing order', 'error' => $e->getMessage()], 500);
    //     }
    // }
}
