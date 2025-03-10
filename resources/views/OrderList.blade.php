<!-- <!DOCTYPE html> -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-DefaultWhite">
    <header class="bg-DefaultWhite shadow-xl fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('assets/Image/Logo copy.png') }}" alt="Logo" class="h-14 w-14">
                <span class="ml-2 text-xl font-bold text-gray-800">PlateItForward</span>
            </div>

            <!-- Hamburger Button -->
            <button id="hamburger-btn" class="block lg:hidden text-gray-600 focus:outline-none">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>

            <!-- Navigation Links -->
            <nav id="menu"
                class="hidden absolute top-16 right-6 bg-DefaultWhite w-48 shadow-lg border border-gray-300 p-2 lg:flex lg:relative lg:top-auto lg:right-auto lg:w-auto lg:shadow-none lg:border-none lg:p-0">
                <ul class="flex flex-col lg:flex-row lg:space-x-10 text-gray-600">
                    <li><a href="/admin/dashboard"
                            class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Dashboard</a>
                    </li>
                    <li><a href="/OrderList" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Order</a>
                    </li>
                    <li><a href="/userinfo" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">User</a>
                    </li>
                    <li><a href="/restaurantinfo"
                            class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Restaurant</a>
                    </li>
                    <li><a href="/panti" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Orphanage</a></li>
                    <li><a href="/supportAdmin" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Support</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- Container Utama -->
    <div class="container mx-auto px-4 my-10">
        <!-- Judul -->
        <div class="flex flex-col">
            <h1 class="text-3xl font-bold text-teal-700 mb-6 font-brandon">Order List</h1>
        </div>

        <!-- Tabel -->
        <div class="bg-white shadow-md rounded-lg p-4 mt-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2">Order ID</th>
                        <th class="p-2">Transaction Detail</th>
                        <th class="p-2">Total Price</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allOrders as $order)
                        <tr>
                            <td class="p-2">{{ $order->id }}</td>
                            <td class="p-2">{{ $order->transaction_detail }}</td>
                            <td class="p-2 font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>
                                <form method="POST" class="flex justify-between"
                                    action="{{ route('admin.OrderList') }}" onsubmit="showLoading()">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <select name="status" class="border px-3 py-2 text-sm text-gray-700 update-status"
                                        data-order-id="{{ $order->id }}"
                                        onchange="updateStatus(event, {{ $order->id }})">
                                        <option value="Paid" {{ $order->status == 'Paid' ? 'selected' : '' }}
                                            class="text-red-500">Paid</option>
                                        <option value="On Process"
                                            {{ $order->status == 'On Process' ? 'selected' : '' }}
                                            class="text-orange-500">On Process</option>
                                        <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}
                                            class="text-green-500">Completed</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="loadingOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-5 rounded-lg flex flex-col items-center">
            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-DefaultGreen"></div>
            <p class="mt-3 text-gray-700">Loading...</p>
        </div>
    </div>
    <script>
        // Fungsi untuk menampilkan loading overlay
        function showLoading() {
            document.getElementById('loadingOverlay').classList.remove('hidden');
        }

        // Fungsi untuk menangani perubahan status menggunakan AJAX
        function updateStatus(event, orderId) {
            const status = event.target.value;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Menampilkan overlay loading saat status diubah
            showLoading();

            // Mengirimkan request AJAX untuk memperbarui status
            fetch("{{ route('admin.OrderList') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token,
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Menutup loading overlay setelah berhasil
                    document.getElementById('loadingOverlay').classList.add('hidden');

                    // Jika status berhasil diupdate, Anda bisa menampilkan pesan atau merender ulang status di halaman
                    // if (data.success) {
                    //     alert("Status berhasil diperbarui!");
                    // } else {
                    //     alert("Terjadi kesalahan saat memperbarui status.");
                    // }
                })
                .catch(error => {
                    document.getElementById('loadingOverlay').classList.add('hidden');
                    alert("Terjadi kesalahan: " + error);
                });
        }
    </script>




    <!-- script untuk mengubah warna status -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElements = document.querySelectorAll('.update-status');

            selectElements.forEach(select => {
                select.addEventListener('change', function() {
                    const orderId = select.getAttribute('data-order-id');
                    const status = select.value;

                    // Kirim permintaan POST untuk memperbarui status
                    fetch('{{ route('admin.OrderList') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Pastikan CSRF token dikirim
                            },
                            body: JSON.stringify({
                                order_id: orderId,
                                status: status,
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {

                        })
                        .catch(error => {
                            alert('Terjadi kesalahan, coba lagi.');
                        });
                });
            });
        });
    </script>

    <script>
        // Fungsi untuk memperbarui warna teks elemen select berdasarkan pilihan
        function updateColor(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex]; // Mendapatkan option yang dipilih
            const status = selectedOption.value;

            // Menghapus semua kelas warna yang ada pada elemen select
            selectElement.classList.remove('text-red-500', 'text-green-500', 'text-orange-500');

            // Menambahkan kelas warna sesuai dengan status yang dipilih
            if (status === 'Paid') {
                selectElement.classList.add('text-red-500');
            } else if (status === 'Completed') {
                selectElement.classList.add('text-green-500');
            } else if (status === 'On Process') {
                selectElement.classList.add('text-orange-500');
            }
        }

        // Memastikan warna diterapkan sesuai dengan status yang sudah terpilih saat halaman dimuat
        window.onload = function() {
            const selectElements = document.querySelectorAll('select[name="status"]'); // Pilih semua select
            selectElements.forEach(selectElement => {
                updateColor(selectElement); // Terapkan warna ke setiap elemen
                selectElement.addEventListener('change', () => updateColor(
                    selectElement)); // Tambahkan event listener agar warna berubah ketika status diganti
            });
        };
    </script>
</body>

</html>
