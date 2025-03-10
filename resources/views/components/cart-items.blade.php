@props(['carts'])
@if ($carts && $carts->items->count() > 0)
    @foreach ($carts->items as $item)
        <div class="cartmenulist flex rounded-[10px] w-[90%] gap-[10px] items-center h-[130px] justify-center p-2">
            <div
                class="quantity w-[10%] inline-flex flex-col h-[100px] border-none rounded-[100px] justify-center items-center bg-DefaultGreen">
                <button class="h-[35px] bg-transparent text-white"
                    onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                <input class="w-[100%] text-white text-center border-none pointer-events-none h-[30px] bg-transparent"
                    type="text" id="quantity-{{ $item->id }}" value="{{ $item->quantity }}" readonly>
                <button class="h-[35px] bg-transparent text-white"
                    onclick="updateQuantity({{ $item->id }}, -1)">−</button>
            </div>

            <div class="picturemenu w-[100px] h-[100px] bg-black border-DefaultGreen border-[1px] rounded-[10px]">
                <img class="h-full w-full rounded-[10px]" src="{{ $item->product->image_url }}"
                    alt="{{ $item->product->name }}">
            </div>

            <div class="descmenu flex flex-col justify-between h-full">
                <h1>{{ $item->product->name }}</h1>
                <h2>Rp{{ number_format($item->product->price, 0, ',', '.') }}</h2>
                <h1>Subtotal: Rp{{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</h1>
            </div>
        </div>
    @endforeach
@else
    <p class="text-center">Cart is empty</p>
@endif
