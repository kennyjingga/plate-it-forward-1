<x-html>

    <body class="bg-DefaultWhite text-gray-900 flex flex-col min-h-screen items-center ">
        <x-navbarResto></x-navbarResto>
        <div class="h-[10vh]"></div>
        
        <div class="h-[90%] pt-5">
            <h1 class="text-3xl font-bold text-DefaultGreen">{{ $exp->name }}</h1>
        </div>
        
        <div class="w-[90%] mx-auto mt-24 p-7 rounded-lg relative flex items-center">
            <a href="{{ route('productexp.show', $exp->product_id) }}" class="absolute -top-10 left-0 text-DefaultGreeen font-semibold hover:underline text-DefaultGreen">← Back</a>
        
            <form action="{{ route('productexp.update', $exp->id) }}" method="POST" class="w-full">
                @csrf
                @method('PUT')
    
                <input type="hidden" name="product_id" value="{{ $exp->product_id }}">
    
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Quantity:</label>
                    <input 
                        type="number" 
                        name="quantity" 
                        value="{{ $exp->quantity }}" 
                        class="w-full border border-gray-300 p-3 rounded-md"
                        required
                    >
                </div>
    
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Price Discount:</label>
                    <input 
                        type="number" 
                        name="price_discount" 
                        value="{{ $exp->price_discount }}" 
                        class="w-full border border-gray-300 p-3 rounded-md"
                        required
                    >
                </div>
    
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Expired At:</label>
                    <input 
                        type="date" 
                        name="expired_at" 
                        value="{{ $exp->expired_at }}" 
                        class="w-full border border-gray-300 p-3 rounded-md"
                        required
                    >
                </div>
    
                <button 
                    type="submit" 
                    class="bg-DefaultGreen text-white px-6 py-3 rounded-md hover:bg-green-600 font-semibold"
                >
                    Update
                </button>
            </form>
        </div>
    </body>
    
    </x-html>
    