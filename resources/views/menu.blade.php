<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    <title>Restaurant Menu Page</title>
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-…." crossorigin="anonymous" referrerpolicy="no-referrer"  />
    <link href="/css/tailwind.css" rel="stylesheet">
    <style>
        /* Custom CSS for half-circle cart button */

        .grid-cols-auto-fit {
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        }

        #descOverlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Gelap transparan */
            backdrop-filter: blur(5px);
            /* Blur hanya background */
            z-index: 40;
            /* Di bawah pop-up */
        }

        .desc {
            position: fixed;
            z-index: 50;
            /* Pastikan pop-up tetap di atas */
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        input[type="number"] {
            -moz-appearance: textfield;
            /* Firefox */
            appearance: textfield;
            /* Standar */
            text-align: center;
        }

        /* Hilangkan tombol di WebKit (Chrome, Edge, Safari) */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <!-- Styles / Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="w-full font-brandon flex">
    @if (Auth::check())
        <x-navbarAfterLogin></x-navbarAfterLogin>
    @else
        <x-navbar></x-navbar>
    @endif


    <section class="menu w-full flex flex-col">
        <div class="cardlist bg-[#f9f3f0] w-full items-center justif-center flex flex-col mt-[50px] ">
            <div class="h-[5vh]"> </div>
            <div class="resto w-full  bg-[#f9f3f0] flex flex-col items-center">
                <div class="resto_header w-full h-[180px] bg-[#f9f3f0] flex justify-center items-center gap-[1%] pl-5">
                    <div
                        class="resto_pic w-[135px] bg-[#f9f3f0] h-[125-x] justify-center rounded-[10px] shadow-[1px_1px_1px_#666]">
                        <img class="w-full h-full object-cover rounded-[10px]"
                            src="https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/8ceb09b1-2ff8-4e92-9e84-ae9eb8c70dd2_brand-image_1733091199022.jpg?auto=format"
                            alt="McDonald's, Sentul City">
                    </div>
                    <div class="resto_desc flex flex-col justify-start w-[75%] gap-[3vh] pl-5">
                        <div
                            class="resto_name bg-[#f9f3f0] w-full h-[50px] text-[30px] bold-text items-center text-black">
                            {{ $restsearch->name }}</div>
                        <div
                            class="resto_category bg-[#f9f3f0] h-[50px] w-full left-[200px] text-[20px] text-[#888888] items-center">
                            {{ $restsearch->city }}</div>
                    </div>
                </div>
            </div>


            <div class="w-full flex flex-col items-center gap-3">
                <h1 class="w-[85%] font-bold text-[25px]">Today's menu</h1>
                <div
                    class="cardlistnye bg-[#f9f3f0] w-[85%] grid gap-x-20 gap-y-20 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($products as $product)
                        <div class="card border-2 bg-DefaultWhite w-[100%] h-[500px] rounded-[10px] shadow-[1px_1px_1px_#666] p-5 cursor-pointer"
                            onclick="buttonmenudesc(
                            '{{ $product->name }}',
                            '{{ asset('storage/' . $product->foto) }}',
                            'Rp {{ number_format($product->price, 0, ',', '.') }}',
                            '{{ $product->description }}'
                        )">
                            <img class="h-[70%] w-full object-cover rounded-[10px]"
                                src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->name }}">
                            <div class="flex justify-between">
                                <div>
                                    <h1 class="font-bold text-[20px]">{{ $product->name }}</h1>
                                    <h2 class="text-[16px]">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</h2>
                                    <h3 class="text-[14px]">Stock :
                                        {{ $product->product_exps_sum_quantity ?? 0 }}
                                    </h3>
                                </div>

                                @if (Auth::check())
                                    {{-- <button
                                        class="w-[100px] rounded-md bg-DefaultGreen font-bold text-white cursor-pointer"
                                        onclick="event.stopPropagation(); addToCart('{{ $product->id }}')">
                                        ADD
                                    </button> --}}
                                    <div
                                        class="quantity w-[15%] inline-flex flex-col h-[100px] border-none rounded-[100px] justify-center items-center bg-DefaultGreen">
                                        <button id="plus-{{ $product->id }}"
                                            class="h-[35px] w-[100%] bg-transparent text-white"
                                            onclick="event.stopPropagation(); updateCart('{{ $product->id }}', 'increase', {{ $product->product_exps_sum_quantity ?? 0 }});">+</button>

                                        <input
                                            class="w-[100%] text-white text-center border-none h-[30px] bg-transparent"
                                            type="number" id="quantity-{{ $product->id }}"
                                            value="{{ $cartItems[$product->id] ?? 0 }}" min="0"
                                            oninput="validateQuantity(this, {{ $product->product_exps_sum_quantity ?? 0 }})"
                                            onblur="updateCartManual('{{ $product->id }}', {{ $product->product_exps_sum_quantity ?? 0 }})"
                                            onclick="event.stopPropagation();">

                                        <button id="minus-{{ $product->id }}"
                                            class="h-[35px] w-[100%] bg-transparent text-white"
                                            onclick="event.stopPropagation(); updateCart('{{ $product->id }}', 'decrease', {{ $product->product_exps_sum_quantity ?? 0 }});">−</button>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}">
                                        <button
                                            class="w-[100px] rounded-md bg-DefaultGreen font-bold text-white cursor-pointer p-2"
                                            onclick="event.stopPropagation();">
                                            ADD
                                        </button>
                                    </a>
                                @endif


                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>

        <div id="descOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40"></div>
        <!-- desc part -->
        <div
            class="desc bg-DefaultWhite flex flex-col h-auto fixed items-center justify-center hidden 
            w-[90%] md:w-[50%] lg:w-[40%] xl:w-[30%] 
            top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
            shadow-lg rounded-lg p-5 border border-gray-300">

            <!-- Bagian Header -->
            <div class="bg-DefaultWhite w-full flex flex-col gap-3 relative">
                <button class="absolute top-2 right-3 text-[25px] font-bold bg-transparent"
                    onclick="backbuttonmenudesc()">X</button>
            </div>

            <!-- Gambar & Detail Produk -->
            <div class="w-full flex flex-col items-center gap-3 p-4">
                <img id="descImage" class="h-40 w-40 rounded-lg border-DefaultGreen border-2 object-cover"
                    src="" alt="">
                <h2 id="descName" class="text-lg font-bold"></h2>
                <p id="descDetail" class="px-4 text-sm text-gray-700 text-center"></p>
            </div>


            {{-- <button class="bg-DefaultGreen text-white rounded-md py-2 px-5 w-3/4">ADD TO CART</button> --}}
        </div>
        <div class="h-[5vh] bg-DefaultWhite"></div>

        <x-footer></x-footer>
        <div id="loadingOverlay"
            class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-5 rounded-lg flex flex-col items-center">
                <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-DefaultGreen"></div>
                <p class="mt-3 text-gray-700">Updating cart...</p>
            </div>
        </div>


    </section>

    <script>
        async function updateCart(productId, action, stock) {
            let quantityInput = document.getElementById(`quantity-${productId}`);
            let minusButton = document.getElementById(`minus-${productId}`);
            let plusButton = document.getElementById(`plus-${productId}`);

            let currentQuantity = parseInt(quantityInput.value) || 0;
            let newQuantity = action === 'increase' ? Math.min(currentQuantity + 1, stock) : Math.max(currentQuantity -
                1, 0);

            document.getElementById("loadingOverlay").classList.remove("hidden");

            try {
                let response = await fetch('/update-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: newQuantity
                    })
                });

                let data = await response.json();

                if (data.error) {
                    let confirmReplace = confirm(
                        "Cart Anda berisi produk dari restoran lain. Ingin mengganti restoran?");
                    if (confirmReplace) {
                        document.getElementById("loadingOverlay").classList.remove("hidden");

                        await fetch('/clear-cart', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });

                        let updateResponse = await fetch('/update-cart', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                quantity: 1
                            })
                        });

                        let updateData = await updateResponse.json();
                        if (!updateData.error) {
                            quantityInput.value = 1;
                        }
                    }
                } else {
                    quantityInput.value = newQuantity;
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                document.getElementById("loadingOverlay").classList.add("hidden");
            }

            // Disable/Enable buttons
            minusButton.disabled = newQuantity === 0;
            plusButton.disabled = newQuantity === stock;
        }

        function validateQuantity(input, stock) {
            let value = parseInt(input.value) || 0;
            input.value = Math.min(Math.max(value, 0), stock);
        }

        async function updateCartManual(productId, stock) {
            let quantityInput = document.getElementById(`quantity-${productId}`);
            let minusButton = document.getElementById(`minus-${productId}`);
            let plusButton = document.getElementById(`plus-${productId}`);

            let newQuantity = parseInt(quantityInput.value) || 0;
            newQuantity = Math.min(Math.max(newQuantity, 0), stock); // Batasi ke stok maksimal

            document.getElementById("loadingOverlay").classList.remove("hidden");

            try {
                let response = await fetch('/update-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: newQuantity
                    })
                });

                let data = await response.json();

                if (data.error) {
                    alert("Terjadi kesalahan saat memperbarui keranjang.");
                } else {
                    quantityInput.value = newQuantity;
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                document.getElementById("loadingOverlay").classList.add("hidden");
            }

            // Disable/Enable buttons
            minusButton.disabled = newQuantity === 0;
            plusButton.disabled = newQuantity === stock;
        }





        function clearCartAndAdd(productId, quantity) {
            fetch('/clear-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(() => {
                    updateCart(productId, 'increase');
                });
        }

        function buttonmenudesc(name, image, price, description) {
            document.getElementById("descName").textContent = name;
            document.getElementById("descImage").src = image;
            document.getElementById("descDetail").textContent = description;

            const descPopup = document.querySelector('.desc');
            const overlay = document.getElementById("descOverlay");

            descPopup.classList.replace('hidden', 'flex');
            overlay.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');
        }

        function backbuttonmenudesc() {
            const descPopup = document.querySelector('.desc');
            const overlay = document.getElementById("descOverlay");

            descPopup.classList.replace('flex', 'hidden');
            overlay.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');
        }
    </script>



</body>


</html>
