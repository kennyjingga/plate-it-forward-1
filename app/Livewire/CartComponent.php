<?php

// namespace App\Http\Livewire;

// use Livewire\Component;
// use Illuminate\Support\Facades\Auth;
// use App\Models\Cart;
// use App\Models\CartItem;
// use App\Models\Products;

// class CartComponent extends Component
// {
//     public $cart;

//     public function mount($restaurant_id = null)
//     {

//         if (Auth::check()) {
//             $this->cart = Cart::where('user_id', Auth::id())
//                 ->with('items.product')
//                 ->first();
//         }
//         dd($this->cart);
//     }

//     public function addToCart($productId)
//     {
//         if (!Auth::check()) return;

//         $product = Products::findOrFail($productId);
//         $userId = Auth::id();
//         $cart = Cart::firstOrCreate(['user_id' => $userId], ['total' => 0]);

//         $cartItem = $cart->items()->where('product_id', $productId)->first();

//         if ($cartItem) {
//             $cartItem->increment('quantity');
//             $cartItem->subtotal = $cartItem->quantity * $cartItem->price;
//             $cartItem->save();
//         } else {
//             $cart->items()->create([
//                 'product_id' => $product->id,
//                 'quantity' => 1,
//                 'price' => $product->price,
//                 'subtotal' => $product->price
//             ]);
//         }

//         $cart->total = $cart->items()->sum('subtotal');
//         $cart->save();

//         $this->cart = $cart;
//     }

//     public function updateQuantity($itemId, $action)
//     {
//         $cartItem = CartItem::findOrFail($itemId);

//         if ($action === 'increase') {
//             $cartItem->increment('quantity');
//         } elseif ($action === 'decrease' && $cartItem->quantity > 1) {
//             $cartItem->decrement('quantity');
//         } else {
//             $cartItem->delete();
//         }

//         if ($cartItem->exists) {
//             $cartItem->subtotal = $cartItem->quantity * $cartItem->price;
//             $cartItem->save();
//         }

//         $cart = Cart::find($cartItem->cart_id);
//         $cart->total = $cart->items()->sum('subtotal');
//         $cart->save();

//         $this->cart = $cart;
//     }

//     public function render()
//     {
//         return view('livewire.cart-component');
//     }
// }
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $cart;
    public $cartItems = [];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $user = Auth::user();
        $this->cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $this->cartItems = CartItem::where('cart_id', $this->cart->id)->with('product')->get();
    }

    public function addToCart($productId)
    {
        $product = Products::find($productId);
        if (!$product) return;

        $cartItem = CartItem::where('cart_id', $this->cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
            $cartItem->subtotal = $cartItem->quantity * $cartItem->price;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $this->cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'subtotal' => $product->price,
            ]);
        }

        $this->updateTotal();
        $this->loadCart();
    }

    public function removeFromCart($cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);
        if ($cartItem) {
            $cartItem->delete();
            $this->updateTotal();
        }
        $this->loadCart();
    }

    public function updateTotal()
    {
        $total = CartItem::where('cart_id', $this->cart->id)->sum('subtotal');
        $this->cart->update(['total' => $total]);
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
