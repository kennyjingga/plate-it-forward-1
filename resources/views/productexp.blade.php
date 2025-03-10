<x-html>

    <x-navbarResto></x-navbarResto>

<body class="bg-DefaultWhite flex flex-col items-center">
    <div class="h-[10vh]"></div> 

    <div class="w-[90%]">

        <h1 class="text-2xl font-bold mb-4">Detail Produk: {{ $product->name }}</h1>
        <img src="{{ url('storage/'. $product->foto )}}" alt="" class="w-32 h-32">
        <p class="mb-2"><strong>Harga:</strong> Rp{{ number_format((int) $product->price) }}</p>
        <p class="mb-2"><strong>Deskripsi:</strong> {{ $product->description }}</p>

        <div class="w-11/12 mx-auto flex justify-between items-center">
            <h2 class="text-2xl font-bold text-DefaultGreen">Product’s Expired Information</h2>
            <div class="flex">
                <a href="{{ route('productexp.create', ['product_id' => $product->id]) }}" class="text-DefaultGreen text-3xl">
                    <button class="text-DefaultGreen text-2xl">✚</button>                    
                </a>

                    <button id="delete-btn" onclick="handleTrashButton()" class="text-2xl">🗑️</button> 
          
                
                <form id="delete-form" action="{{ route('productexp.deleteMultiple') }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>

           
            </div>
        </div>

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Expired Date</th>
                        <th class="px-4 py-2 border">Price</th>
                        <th class="px-4 py-2 border">Quantity</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($productExps as $index => $exp)
                        <tr class="text-center">
                            <td class="border px-4 py-2 relative">
                                <input type="checkbox" class="hidden checkbox-item" name="delete_ids[]" value="{{ $exp->id }}" style="margin-right: 8px;">
                                <div class="action-menu">
                                    <button onclick="toggleActionMenu({{ $exp->id }})">⋮</button>
                                    <div id="menu-{{ $exp->id }}" class="absolute top-8 left-0 bg-white border shadow-md rounded hidden w-28 z-50">

                                        <a href="{{ route('productexp.edit', $exp->id) }}" class="block px-4 py-2 hover:bg-gray-100">Update</a>
                                        <form action="{{ route('productexp.delete') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="delete_ids[]" value="{{ $exp->id }}">
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $exp->expired_at }}</td>
                            <td class="border px-4 py-2">{{ $exp->price_discount }}</td>
                            <td class="border px-4 py-2">{{ $exp->quantity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-gray-500 border px-4 py-2 text-center">Belum ada data expiry date</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4 text-right font-bold text-lg">
                Total Quantity: <span class="text-DefaultGreen">{{ $totalQuantity }}</span>
            </div>
        </div>
        <div class="flex justify-between">
            
        <a href="{{ route('products') }}" class="mt-4 inline-block bg-DefaultGreen text-white px-4 py-2 rounded">Kembali</a>

        
        <button id="delete-selected-btn" class="hidden bg-red-500 text-white px-4 py-2 rounded" onclick="submitDeleteForm()">Hapus yang Dichecklist</button>
        </div>


        <script>
     

            function toggleActionMenu(id) {
                const menu = document.getElementById(`menu-${id}`);
                menu.classList.toggle('hidden');
                setTimeout(() => {
                    document.addEventListener('click', function hideMenu(e) {
                        if (!menu.contains(e.target) && !e.target.closest('.action-menu')) {
                            menu.classList.add('hidden');
                            document.removeEventListener('click', hideMenu);
                        }
                    });
                }, 0);
            }


        function handleTrashButton() {
        const checkboxes = document.querySelectorAll('.checkbox-item');
        const actions = document.querySelectorAll('.action-menu');
        const deleteSelectedBtn = document.getElementById('delete-selected-btn');

        checkboxes.forEach(checkbox => checkbox.classList.toggle('hidden'));
        actions.forEach(action => action.classList.toggle('hidden'));

        if (!checkboxes[0].classList.contains('hidden')) {
            deleteSelectedBtn.classList.remove('hidden'); // Tampilkan tombol "Hapus yang Dichecklist"
        } else {
            deleteSelectedBtn.classList.add('hidden'); // Sembunyikan tombol jika checkbox disembunyikan
        }
    }

    function submitDeleteForm() {
        const checkboxes = document.querySelectorAll('.checkbox-item:checked');
        const deleteForm = document.getElementById('delete-form');

        if (checkboxes.length === 0) {
            alert('Pilih data terlebih dahulu!');
            return;
        }

        checkboxes.forEach(checkbox => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_ids[]';
            input.value = checkbox.value;
            deleteForm.appendChild(input);
        });

        if (confirm('Yakin ingin menghapus data yang dipilih?')) {
            deleteForm.submit();
        }
    }
</script>
        </script>


</body>
</x-html>