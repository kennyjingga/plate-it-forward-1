<x-html>

    
<body class="bg-DefaultWhite text-gray-900 flex flex-col min-h-screen">

    <x-navbarResto>
        
    </x-navbarResto>
    

    <!-- Main Content -->
    <div class="w-full pt-40 mx-auto py-8 flex-grow items-center">
        <div class="w-11/12 mx-auto flex justify-between items-center">
            <h2 class="text-2xl font-bold text-DefaultGreen">Product’s Information</h2>
            <div>
                <a href="{{ route('products.create') }}" class="text-DefaultGreen text-3xl">
                    <button class="text-DefaultGreen text-2xl">✚</button>
                </a>
    
                <button id="delete-btn" onclick="toggleCheckboxes()" class="text-2xl">🗑️</button>
            </div>
        </div>
    
        <form id="delete-form" action="{{ route('products.delete') }}" method="POST">
            @csrf
            @method('DELETE')
    
            <div class="w-full p-6 px-4 sm:px-6 md:px-8 lg:px-12">
                <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($products as $prd)
                    <div class="bg-white rounded-xl shadow-lg p-5 border relative">
                        <input type="checkbox" name="products[]" value="{{ $prd->id }}" 
                               class="absolute top-3 left-3 w-6 h-6 hidden checkbox">
                        <img src="{{ asset('storage/' . $prd->foto) }}" alt="Product Image" 
                             class="w-full h-56 object-cover rounded-lg">
                        <div class="mt-4">
                            <h1 class="text-lg font-bold">{{ $prd->name }}</h1>
                            <p class="text-gray-600 text-md mt-2">Rp. {{ number_format((int) $prd->price) }}</p>
                            <div class="mt-4 flex justify-between">
                                <a href="{{ route('productexp.show', $prd->id) }}" 
                                   class="w-[48%] bg-DefaultGreen text-white py-3 rounded-lg font-semibold text-lg text-center">
                                    ADD
                                </a>
                            
                                <a href="{{ route('products.edit', $prd->id) }}" 
                                   class="w-[48%] bg-yellow-500 text-white py-3 rounded-lg font-semibold text-lg text-center">
                                    UPDATE
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
    
                <button type="submit" id="confirm-delete-btn" 
                        class="hidden bg-DefaultGreen text-white px-4 py-2 rounded-lg mt-4">
                    Hapus yang Dicentang
                </button>
            </div>
        </form>
    </div>
    
    <script>
        function toggleCheckboxes() {
            const checkboxes = document.querySelectorAll('.checkbox');
            const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    
            checkboxes.forEach(checkbox => {
                checkbox.classList.toggle('hidden');
            });
    
            confirmDeleteBtn.classList.toggle('hidden');
        }
    </script>
    
        
        
        
        
        


      
       
        
            
    </div>

    <!-- Footer -->
        <footer class="bg-DefaultGreen text-white text-center py-20">
            <!-- Icons Section -->
            <div class="flex justify-center space-x-6 mb-3">
                <a href="#" class="text-xl hover:text-gray-300">
                    <i class="fab fa-facebook"></i> <!-- Replace with actual icon -->
                </a>
                <a href="#" class="text-xl hover:text-gray-300">
                    <i class="fab fa-youtube"></i> <!-- Replace with actual icon -->
                </a>
                <a href="#" class="text-xl hover:text-gray-300">
                    <i class="fab fa-x"></i> <!-- Replace with actual icon -->
                </a>
                <a href="#" class="text-xl hover:text-gray-300">
                    <i class="fab fa-instagram"></i> <!-- Replace with actual icon -->
                </a>
                <a href="#" class="text-xl hover:text-gray-300">
                    <i class="fab fa-whatsapp"></i> <!-- Replace with actual icon -->
                </a>
            </div>
        
            <!-- Navigation Links -->
            <div class="flex justify-center space-x-8 mb-3">
                <a href="/" class="text-base hover:underline">Home</a>
                <a href="/restaurants" class="text-base hover:underline">Restaurant</a>
                <a href="/my-donations" class="text-base hover:underline">My Donations</a>
                <a href="/contact-us" class="text-base hover:underline">Contact Us</a>
            </div>
        
            <!-- Copyright Text -->
            <div class="text-sm">
                © Plate it Forward 2025 | All Rights Reserved
            </div>
        </footer>

    
</body>
</x-html>
