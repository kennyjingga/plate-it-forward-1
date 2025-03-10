{{-- <div class="cartye fixed right-0 top-0 w-[350px] h-full bg-white shadow-lg p-4">
    <h2 class="text-xl font-bold">Your Cart</h2>
    @if ($cart && count($cart->items) > 0)
        <ul class="divide-y">
            @foreach ($cart->items as $item)
                <li class="py-2 flex justify-between items-center">
                    <span>{{ $item->product->name }}</span>
                    <div class="flex items-center">
                        <button class="bg-gray-300 px-2"
                            wire:click="updateQuantity({{ $item->id }}, 'decrease')">-</button>
                        <span class="mx-2">{{ $item->quantity }}</span>
                        <button class="bg-gray-300 px-2"
                            wire:click="updateQuantity({{ $item->id }}, 'increase')">+</button>
                    </div>
                </li>
            @endforeach
        </ul>
        <p class="mt-4 font-bold">Total: Rp {{ number_format($cart->total, 0, ',', '.') }}</p>
    @else
        <p class="text-gray-500">Your cart is empty</p>
    @endif
</div> --}}
<div class="p-4 bg-white shadow-lg rounded-md">
    <h2 class="text-lg font-bold mb-3">Cart</h2>
    @if ($cartItems->isEmpty())
        <p>Cart is empty.</p>
    @else
        <ul>
            @foreach ($cartItems as $item)
                <li class="flex justify-between items-center border-b py-2">
                    <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                    <span class="font-bold">${{ number_format($item->subtotal, 2) }}</span>
                    <button wire:click="removeFromCart({{ $item->id }})" class="text-red-500">Remove</button>
                </li>
            @endforeach
        </ul>
        <div class="font-bold text-right mt-3">
            Total: ${{ number_format($cart->total, 2) }}
        </div>
    @endif
</div>
