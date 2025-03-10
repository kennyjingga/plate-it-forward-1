<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-…." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-DefaultWhite overflow-x-hidden">

    <x-navbar></x-navbar>
    <div
        class="relative bg-bgbang bg-no-repeat bg-cover bg-center h-[80vh] flex flex-col justify-center items-center text-center pt-[19rem]">

        <!-- Image Above Title -->
        <div class="flex flex-col justify-end items-center h-[40vh] w-screen">
            <img src="{{ asset('assets/Image/logo.png') }}" alt="Above Title Image"
                class="relative top-[-39px] w-[90%] h-[50%] sm:w-[40%] md:w-[35%] lg:w-[30%] xl:w-[25%] object-contain">
        </div>

        <!-- Title & Description -->
        <div class="relative top-[-50px] z-20 text-white mt-2 px-4 sm:px-8 w-[70vw]">
            <h1 class="text-4xl sm:text-5xl font-bold font-brandon">A small act, a big impact!</h1>
            <p class="mt-4 w-4/5 mx-auto sm:w-2/3 text-lg font-brandon">
                Plate It Forward transforms small acts into big impacts by partnering with restaurants providing meals
                for those in need, creating employment opportunities.
            </p>
        </div>

        <!-- Search Bar -->
        <div class="relative z-20 w-full flex justify-center items-center mt-10 px-4 sm:px-8">
            <div
                class="flex flex-col bg-white rounded-[20px] p-4 shadow-lg w-[90%] sm:w-[80%] md:w-[60%] lg:w-[50%] xl:w-[40%]">

                <!-- Label -->
                <div class="mb-2 flex">
                    <label for="location" class="text-black font-semibold text-lg">Location</label>
                </div>

                <!-- Search Bar -->
                <div class="relative flex items-center">
                    <!-- Input -->
                    <input type="text" id="location" placeholder="Type a location"
                        class="flex-1 py-2 px-4 rounded-full border border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300" />

                    <!-- Search Button -->
                    <button id="search-button"
                        class="ml-2 px-4 py-2 bg-teal-700 text-white font-semibold rounded-full hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        Search
                    </button>

                    <!-- Dropdown Suggestions -->
                    <ul id="location-list"
                        class="hidden absolute left-0 top-full mt-1 bg-white w-full rounded-lg shadow-md max-h-40 overflow-y-auto z-50 text-left">
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div>
        <h3 class="flex justify-center pt-28 text-4xl font-brandon">Choose From Places</h3>
    </div>

    <div
        class="flex justify-center pt-7 pb-7 gap-20 max-[1317px]:gap-8 overflow-hidden max-[1317px]:flex-wrap max-[430px]:gap-4">
        <!-- Item Jakarta -->
        @foreach ($city->unique('city') as $item)
            <div class="text-center max-[430px]:w-1/3">
                <div
                    class="max-[1317px]:w-60 max-[1317px]:h-60 max-[430px]:w-20 max-[430px]:h-20 w-40 h-40 mx-auto rounded-full overflow-hidden border-2 border-gray">
                    <a href="{{ route('resto.list', ['city' => $item->city]) }}"><img
                            src="{{ asset('assets/Image/keram_telor.png') }}" alt="Jakarta"
                            class="w-full h-full object-cover"></a>
                </div>
                <p
                    class="mt-2 text-lg font-semibold italic font-BrandonGrotesque max-[1317px]:text-[30px] max-[430px]:text-[15px]">
                    {{ $item->city }}</p>
            </div>
        @endforeach
    </div>

    <div>
        <h3 class="flex justify-center pt-10 text-4xl font-brandon">Flash Sale</h3>
    </div>

    <div>
        <h1 class="flex justify-center pt-10 text-2xl font-brandon max-[500px]:text-xl">Come on, choose food that is
            interesting to you</h1>
    </div>

    <!-- Container -->
    <div class="relative overflow-hidden pt-5">
        <!-- Wrapper -->
        <div class="flex overflow-x-auto no-scrollbar gap-5 px-5">
            @foreach ($flashSaleProducts as $item)
                <!-- Card -->
                <div
                    class="flex-shrink-0 w-80 bg-white rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:scale-105 hover:bg-gray-100 relative">
                    <!-- Logo Discount -->
                    <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                        {{ number_format(($item->price_discount / 100) * 100, 0) }}% OFF
                    </div>
                    <img class="w-full h-48 object-cover" src="https://via.placeholder.com/300"
                        alt="{{ $item->name }}" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold italic">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500 mb-2">Kategori</p>
                        <div class="flex items-center mb-3">
                            <span class="text-yellow-400">★</span>
                            <span class="text-gray-700 font-semibold ml-1">4.5</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <span class="text-sm font-medium">Rp
                                {{ number_format($item->price_discount, 0, ',', '.') }}</span>
                            <span class="ml-2 text-sm">({{ $item->quantity }} Stok)</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div>
        <h3 class="flex justify-center pt-10 text-4xl font-brandon max-[500px]:text-xl max-[529px]:text-xl">RECOMMENDED
            RESTAURANT</h3>
    </div>

    <!-- Container -->
    <div class="flex flex-wrap gap-10 justify-center m-9">
        @foreach ($recommendedRestaurants as $restaurant)
            <!-- Card -->
            <div
                class="w-full sm:w-80 md:w-96 bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out">
                <a href="{{ route('menupage', ['id' => $restaurant->id]) }}">
                    <img class="w-full h-48 object-cover" src="{{ asset('assets/Image/Mcd.jpg') }}"
                        alt="{{ $restaurant->name }}">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold italic font-BrandonGrotesque">{{ $restaurant->name }}</h3>
                        <p class="text-sm text-gray-500 mb-2">Kategori Makanan</p>
                        <div class="flex items-center mb-3">
                            <span class="text-yellow-400">★</span>
                            <span class="text-gray-700 font-semibold ml-1">4.9</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <span class="text-sm font-medium">$$</span>
                            <span class="ml-2 text-sm">(30K+)</span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <x-footer></x-footer>

    <script>
        $(document).ready(function() {
            let debounceTimer;

            $("#location").on("input", function() {
                clearTimeout(debounceTimer);
                let query = $(this).val().trim();

                if (query.length > 0) {
                    debounceTimer = setTimeout(function() {
                        $.ajax({
                            url: "/search-location",
                            type: "GET",
                            data: {
                                query: query
                            },
                            success: function(data) {
                                let dropdown = $("#location-list");
                                dropdown.empty().removeClass("hidden");

                                console.log("Data dari backend:", data); // Debugging

                                if (Array.isArray(data) && data.length > 0) {
                                    let uniqueLocations = [...new Set(
                                        data)]; // Buat data unik

                                    uniqueLocations.forEach(function(location) {
                                        dropdown.append(
                                            `<li class="p-2 hover:bg-gray-200 cursor-pointer" data-city="${location}">${location}</li>`
                                        );
                                    });
                                } else {
                                    dropdown.append(
                                        `<li class="p-2 text-gray-500">No results found</li>`
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log("AJAX Error:", status, error);
                            }
                        });
                    }, 300);
                } else {
                    $("#location-list").addClass("hidden");
                }
            });

            // Autocomplete saat klik opsi dropdown
            $(document).on("click", "#location-list li", function() {
                let selectedCity = $(this).data("city");
                $("#location").val(selectedCity);
                $("#location-list").addClass("hidden");
            });

            // Redirect saat klik tombol search
            $("#search-button").on("click", function() {
                let selectedCity = $("#location").val().trim();
                if (selectedCity) {
                    window.location.href = `/location?city=${encodeURIComponent(selectedCity)}`;
                }
            });

            // Sembunyikan dropdown saat klik di luar
            $(document).on("click", function(e) {
                if (!$(e.target).closest(".relative").length) {
                    $("#location-list").addClass("hidden");
                }
            });
        });
    </script>

</body>

</html>
