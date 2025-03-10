<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-…." crossorigin="anonymous" referrerpolicy="no-referrer"  />
    <title>Restaurant Menu Page</title>
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="/css/tailwind.css" rel="stylesheet">
    <style>
        :root {
            --background: #f9f3f0;
            --border-color: #00615f;
            --text-dark: #333333;
            --primary: #00615f;
            --secondary: #dfd7d3;
            --accent: #00885c;
            --boxbg: #00615F1A;
        }

        .custom-box {
            background-color: #f9f3f0;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 16px;
        }

        .donate-button {
            background-color: var(--primary);
            color: #f9f3f0;
            font-weight: bold;
            font-size: 1rem;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="w-full font-brandon bg-DefaultWhite">

    <x-navbarAfterLogin></x-navbarAfterLogin>
    @if (!$cart)
        <div class="text-center text-gray-500 font-medium mt-32 h-[100vh]">
            Cart is empty
        </div>
    @else
        <div class="w-[90%] mx-auto p-6 h-[100%] pb-10">
            <!-- Header -->
            <div class="flex justify-between items-center mt-[100px]">
                <a href="/restoranpage"><button class="text-[var(--primary)] text-xl font-bold">&larr;</button></a>

                <div></div>
            </div>

            <!-- Store Name -->
            <h1 class="text-[var(--primary)] font-bold text-xl text-center">CART</h1>
            <h2 class="text-center text-gray-500 text-lg mb-6">{{ $restaurant ? $restaurant->name : '' }}</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Orders Section -->
                <div class="bg-[var(--boxbg)] col-span-2 custom-box">
                    <div class="flex justify-between items-center">
                        <h3 class="text-[var(--text-dark)] font-bold text-lg">Orders</h3>
                        <a href="{{ $restaurant ? '/menu?id=' . $restaurant->id : '/restoranpage' }}"
                            class="text-[var(--primary)] text-sm font-medium">Edit
                            Cart</a><!-- menuju ke menu.blade.php dengan id resto-->
                    </div>
                    <div class="mt-4 space-y-4">
                        <!-- Item 1 -->
                        {{-- <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/21c4f66a-e600-44f5-bae2-3488e17d979d_TPO-111226_1.jpg?auto=format"
                                alt="Product" class="w-20 h-20 rounded-md">
                            <div class="ml-4">
                                <h4 class="text-[var(--text-dark)] font-bold">PaNas 1 Ayam McD Gulai Spicy</h4>
                                <!--nama menu-->
                                <p class="text-gray-500 text-sm">Quantity : 1</p><!--nama menu-->
                                <p class="text-gray-500 text-sm">Price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                    Rp 42.500</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-[var(--text-dark)] font-bold">Rp 42.500</p>

                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/21c4f66a-e600-44f5-bae2-3488e17d979d_TPO-111226_1.jpg?auto=format"
                                alt="Product" class="w-20 h-20 rounded-md">
                            <div class="ml-4">
                                <h4 class="text-[var(--text-dark)] font-bold">PaNas 1 Ayam McD Gulai Spicy</h4>
                                <!--nama menu-->
                                <p class="text-gray-500 text-sm">Quantity : 1</p><!--nama menu-->
                                <p class="text-gray-500 text-sm">Price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                    Rp 42.500</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-[var(--text-dark)] font-bold">Rp 42.500</p>

                        </div>
                    </div> --}}
                        @foreach ($cartItems as $item)
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <img src="{{ $item->product->image_url }}" alt="Product"
                                        class="w-20 h-20 rounded-md">
                                    <div class="ml-4">
                                        <h4 class="text-[var(--text-dark)] font-bold">{{ $item->product->name }}</h4>
                                        <p class="text-gray-500 text-sm">Quantity : {{ $item->quantity }}</p>
                                        <p class="text-gray-500 text-sm">Price
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                            Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[var(--text-dark)] font-bold">Rp
                                        {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>

                <!-- Right Section (Summary, Payment Method, Button) -->
                <div class="space-y-6">
                    <!-- Summary Section -->
                    <div class="bg-[var(--boxbg)] custom-box">
                        <h3 class="text-[var(--text-dark)] font-bold text-lg">Summary</h3>

                        <div class="mt-4 space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Subtotal</span>
                                <span class="text-[var(--text-dark)] font-bold">Rp
                                    {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Service Fee (5% Subtotal)</span>
                                <span class="text-[var(--text-dark)] font-bold">Rp
                                    {{ number_format($serviceFee, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <hr class="border-t-[var(--border-color)] my-4">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-[var(--primary)]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                    </div>

                    {{-- <div class="bg-[var(--boxbg)] custom-box">
                        <h3 class="text-[var(--text-dark)] font-bold text-lg">Payment Method</h3>

                        <!-- Hidden default select for form submission -->
                        <select id="payment-method" class="hidden">
                            <option value="gopay" data-image="http://localhost/inimenupage/assets/Image/Gopay.png">
                                GoPay
                            </option>
                            <option value="ovo" data-image="https://via.placeholder.com/30x30.png?text=OVO">OVO
                            </option>
                            <option value="dana" data-image="https://via.placeholder.com/30x30.png?text=DANA">DANA
                            </option>
                            <option value="shopeepay" data-image="https://via.placeholder.com/30x30.png?text=ShopeePay">
                                ShopeePay</option>
                            <option value="linkaja"
                                data-image="https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/LinkAja.svg/120px-LinkAja.svg.png">
                                LinkAja</option>
                            <option value="virtual-account" data-image="https://via.placeholder.com/30x30.png?text=VA">
                                Virtual Account</option>
                            <option value="credit-debit-card"
                                data-image="https://via.placeholder.com/30x30.png?text=Card">
                                Debit/Credit Card</option>
                        </select>

                        <!-- Custom dropdown container -->
                        <div id="custom-dropdown" class="relative mt-4">
                            <button id="dropdown-btn"
                                class="font-bold flex items-center justify-between w-full p-2 rounded-md bg-[var(--boxbg)]">
                                <span class="flex items-center gap-2">
                                    <img id="selected-image" src="https://via.placeholder.com/30x30.png?text=GoPay"
                                        alt="Selected Payment Logo" class="w-6 h-6" />
                                    <span id="selected-text">GoPay</span>
                                </span>
                                <span>&#9660;</span>
                            </button>

                            <!-- Dropdown menu -->
                            <ul id="dropdown-menu"
                                class="absolute z-10 hidden w-full mt-2 bg-[#b6cecd] border border-gray-300 rounded-md shadow-lg">
                                <li class="flex items-center gap-2 p-2 cursor-pointer bg-[var(--boxbg)] hover:bg-gray-100"
                                    data-value="gopay" data-image="https://via.placeholder.com/30x30.png?text=GoPay">
                                    <img src="public/assets/Image/Gopay.png" alt="GoPay Logo" class="w-6 h-6" />
                                    GoPay
                                </li>
                                <li class="flex items-center gap-2 p-2 cursor-pointer hover:bg-gray-100"
                                    data-value="ovo" data-image="https://via.placeholder.com/30x30.png?text=OVO">
                                    <img src="https://via.placeholder.com/30x30.png?text=OVO" alt="OVO Logo"
                                        class="w-6 h-6" />
                                    OVO
                                </li>
                                <li class="flex items-center gap-2 p-2 cursor-pointer hover:bg-gray-100"
                                    data-value="dana" data-image="https://via.placeholder.com/30x30.png?text=DANA">
                                    <img src="https://via.placeholder.com/30x30.png?text=DANA" alt="DANA Logo"
                                        class="w-6 h-6" />
                                    DANA
                                </li>
                                <li class="flex items-center gap-2 p-2 cursor-pointer hover:bg-gray-100"
                                    data-value="shopeepay"
                                    data-image="https://via.placeholder.com/30x30.png?text=ShopeePay">
                                    <img src="https://via.placeholder.com/30x30.png?text=ShopeePay"
                                        alt="ShopeePay Logo" class="w-6 h-6" />
                                    ShopeePay
                                </li>
                                <li class="flex items-center gap-2 p-2 cursor-pointer hover:bg-gray-100"
                                    data-value="linkaja"
                                    data-image="https://via.placeholder.com/30x30.png?text=LinkAja">
                                    <img src="https://via.placeholder.com/30x30.png?text=LinkAja" alt="LinkAja Logo"
                                        class="w-6 h-6" />
                                    LinkAja
                                </li>
                                <li class="flex items-center gap-2 p-2 cursor-pointer hover:bg-gray-100"
                                    data-value="virtual-account"
                                    data-image="https://via.placeholder.com/30x30.png?text=VA">
                                    <img src="https://via.placeholder.com/30x30.png?text=VA"
                                        alt="Virtual Account Logo" class="w-6 h-6" />
                                    Virtual Account
                                </li>
                                <li class="flex items-center gap-2 p-2 cursor-pointer hover:bg-gray-100"
                                    data-value="credit-debit-card"
                                    data-image="https://via.placeholder.com/30x30.png?text=Card">
                                    <img src="https://via.placeholder.com/30x30.png?text=Card" alt="Card Logo"
                                        class="w-6 h-6" />
                                    Debit/Credit Card
                                </li>
                            </ul>
                        </div>

                        <!-- Virtual Account Options -->
                        <div id="virtual-account-options" class="hidden mt-4">
                            <label for="bank" class="block text-sm font-medium text-gray-700">Choose Bank</label>
                            <select id="bank" class="w-full mt-2 p-2 border rounded-md">
                                <option value="bca">BCA</option>
                                <option value="bni">BNI</option>
                                <option value="mandiri">Mandiri</option>
                                <option value="bri">BRI</option>
                            </select>
                        </div>

                        <!-- Debit/Credit Card Input -->
                        <div id="card-details" class="hidden mt-4">
                            <label for="card-number" class="block text-sm font-medium text-gray-700">Card
                                Number</label>
                            <input type="text" id="card-number" class="w-full mt-2 p-2 border rounded-md"
                                placeholder="1234 5678 9123 4567">
                            <label for="expiry-date" class="block text-sm font-medium text-gray-700 mt-4">Expiry
                                Date</label>
                            <input type="text" id="expiry-date" class="w-full mt-2 p-2 border rounded-md"
                                placeholder="MM/YY">
                        </div>
                    </div> --}}


                    <!-- Donate Button -->
                    <div class="text-center">
                        <button onclick="payWithMidtrans()" class="donate-button w-full">Donate Now!</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div id="loadingOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-5 rounded-lg flex flex-col items-center">
            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-DefaultGreen"></div>
            <p class="mt-3 text-gray-700">Loading...</p>
        </div>
    </div>

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
            <a href="/restoranpage" class="text-base hover:underline">Restaurant</a>
            <a href="/my-donations" class="text-base hover:underline">My Donations</a>
            <a href="/contact-us" class="text-base hover:underline">Contact Us</a>
        </div>

        <!-- Copyright Text -->
        <div class="text-sm">
            © Plate it Forward 2025 | All Rights Reserved
        </div>
    </footer>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        function payWithMidtrans() {
            console.log("Masuk button");
            document.getElementById("loadingOverlay").classList.remove("hidden");
            fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Data dari server:", data);
                    snap.pay(data.snapToken, {
                        onSuccess: function(result) {
                            console.log("sebelum notif");
                            // Panggil API notifikasi Midtrans ke server

                            fetch('/midtrans/notification', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify(result)
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log("Notifikasi Midtrans diproses:", data);
                                    // Sembunyikan loading overlay sebelum mengarahkan
                                    document.getElementById("loadingOverlay").classList.add("hidden");

                                    // Redirect ke /my-donations setelah berhasil
                                    window.location.href = "/my-donations";
                                })
                                .catch(error => {
                                    console.error("Gagal memproses notifikasi:", error);
                                    document.getElementById("loadingOverlay").classList.add("hidden");
                                    alert("Terjadi kesalahan dalam memproses pembayaran.");
                                });
                        }
                    });
                })
                .catch(error => {
                    console.error("Gagal mengambil Snap Token:", error);
                    document.getElementById("loadingOverlay").classList.add("hidden");
                    alert("Terjadi kesalahan dalam memulai pembayaran.");
                });
        }

        // Toggle dropdown menu visibility
        const dropdownBtn = document.getElementById('dropdown-btn');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const paymentMethodSelect = document.getElementById('payment-method');
        const virtualAccountOptions = document.getElementById('virtual-account-options');
        const cardDetails = document.getElementById('card-details');

        dropdownBtn.addEventListener('click', () => {
            // Toggle visibility of dropdown menu
            dropdownMenu.classList.toggle('hidden');
        });

        // Select a payment option from the dropdown
        const dropdownItems = document.querySelectorAll('#dropdown-menu li');
        dropdownItems.forEach(item => {
            item.addEventListener('click', () => {
                const selectedValue = item.getAttribute('data-value');
                const selectedImage = item.getAttribute('data-image');
                const selectedText = item.textContent.trim();

                // Update button text and image
                document.getElementById('selected-image').src = selectedImage;
                document.getElementById('selected-text').textContent = selectedText;

                // Close the dropdown menu
                dropdownMenu.classList.add('hidden');

                // Update hidden select input value
                paymentMethodSelect.value = selectedValue;

                // Hide all additional options by default
                virtualAccountOptions.classList.add('hidden');
                cardDetails.classList.add('hidden');

                // Show relevant payment options based on selection
                if (selectedValue === 'virtual-account') {
                    virtualAccountOptions.classList.remove('hidden');
                } else if (selectedValue === 'credit-debit-card') {
                    cardDetails.classList.remove('hidden');
                }
            });
        });
    </script>
</body>

</html>
