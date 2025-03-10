<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Support Detail</title>
    <link href="/css/tailwind.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #menu {
            background-color: #F9F3F0 !important;
            opacity: 1 !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-DefaultWhite flex flex-col min-h-screen">

    <!-- Navbar -->
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
    {{-- <x-navbar></x-navbar> --}}

    <!-- Main Content -->
    <div class="w-full pt-40 mx-auto py-8 flex-grow items-center">
        <div class="w-11/12 mx-auto flex justify-between items-center">
            <h2 class="text-2xl font-bold text-DefaultGreen font-gotham">Support</h2>
            {{-- <button id="delete-btn" onclick="handleTrashButton()" class="text-red-600 hover:text-red-800 text-xl">
                🗑️
            </button> --}}
        </div>

        <div class="bg-white rounded-lg w-11/12 mx-auto shadow-md mt-4">
            <!-- Desktop Table -->
            <div class="md:block">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr class="text-left text-gray-600 font-gotham">
                            <th class="p-3"></th>
                            <th class="p-3">Support ID</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">E-mail</th>
                            <th class="p-3">Information</th>
                            <th class="p-3 text-center">Handled</th>
                        </tr>
                    </thead>
                    <tbody id="userTable" class="font-brandon">
                        @foreach ($supports as $support)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3"></td>
                                <td class="p-3">{{ $support->support_id }}</td>
                                <td class="p-3">{{ $support->name }}</td>
                                <td class="p-3">{{ $support->email }}</td>
                                <td class="p-3">{{ $support->information }}</td>
                                <td class="p-3 text-center">
                                    <input type="checkbox" class="handled-checkbox w-5 h-5"
                                        onchange="toggleHandled(this, '{{ $support->support_id }}')"
                                        {{ $support->handled ? 'checked' : '' }}>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            {{-- <div class="md:hidden space-y-4 p-4" id="userCards"></div> --}}
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("input[type=checkbox]").forEach(checkbox => {
                const row = checkbox.closest('tr');
                if (checkbox.checked) {
                    row.classList.add('line-through', 'text-gray-500');
                }
            });
        });

        function toggleHandled(checkbox, id) {
            const row = checkbox.closest('tr');
            const isChecked = checkbox.checked;

            if (isChecked) {
                row.classList.add('line-through', 'text-gray-500');
            } else {
                row.classList.remove('line-through', 'text-gray-500');
            }

            fetch(`/update-handled/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        handled: isChecked
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert('Gagal memperbarui status handled');
                        checkbox.checked = !isChecked;
                        row.classList.toggle('line-through', isChecked);
                        row.classList.toggle('text-gray-500', isChecked);
                    }
                })
                .catch(() => {
                    alert('Terjadi kesalahan, coba lagi.');
                    checkbox.checked = !isChecked;
                    row.classList.toggle('line-through', isChecked);
                    row.classList.toggle('text-gray-500', isChecked);
                });
        }
    </script>


</body>

</html>
