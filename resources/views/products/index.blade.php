@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Product List</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($products as $product)
                <div class="p-4 bg-white shadow-md rounded-lg">
                    <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->name }}"
                        class="w-full h-40 object-cover mb-2">
                    <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                    <p class="text-gray-600">${{ number_format($product->price, 2) }}</p>
                    <button wire:click="$emit('addToCart', {{ $product->id }})"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2">Add to Cart</button>
                </div>
            @endforeach
        </div>

        <h2 class="text-2xl font-bold mt-6">Shopping Cart</h2>
        <livewire:cart-component />
    </div>
@endsection
