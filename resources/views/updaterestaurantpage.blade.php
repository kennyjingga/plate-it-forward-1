<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-DefaultWhite font-sans pt-20 min-h-full">

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
                    <li><a href="/" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Home</a></li>
                    <li><a href="restoranpage" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Restaurants</a>
                    </li>
                    <li><a href="my-donations" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">My
                            Donations</a>
                    </li>
                    <li><a href="contactus" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Contact Us</a>
                    </li>
                    <li><a href="profile" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="w-[90%] mx-auto mt-24 p-7 bg-whitecream rounded-lg relative">
        <a href="/restaurantinfo" class="absolute -top-10 left-0 text-ijo font-semibold hover:underline font-gotham">←
            Back</a>
        <h1 class="text-3xl font-bold text-DefaultGreen font-gotham">Restaurant’s Information</h1>
        <h1 class="text-1xl font-bold text-black font-gotham">Click 'enter' in your keyboard to save changes<br><br></h1>

        <form method="POST" action="{{ route('restaurant.update', $restaurant->id) }}">
            @csrf
            @method('PUT') <!-- Simulate a PUT request -->

            <div class="mb-4">
                <label class="block text-lg font-semibold text-gray-700 font-gotham">Restaurant ID</label>
                <input id="user-id" type="text"
                    class="w-full border border-gray-300 p-3 rounded-md bg-gray-100 font-brandon"
                    value="{{ $restaurant->id }}" readonly>
            </div>

            <div class="mb-4">
                <label class="block text-lg font-semibold text-gray-700 font-gotham">Name</label>
                <input id="user-name" type="text" name="name"
                    class="w-full border border-gray-300 p-3 rounded-md font-brandon"
                    value="{{ old('name', $restaurant->name) }}">
            </div>

            <div class="mb-6">
                <label class="block text-lg font-semibold text-gray-700 font-gotham">E-mail</label>
                <input id="user-email" type="email" name="email"
                    class="w-full border border-gray-300 p-3 rounded-md font-brandon"
                    value="{{ old('email', $restaurant->email) }}">
            </div>

            <div class="mb-6">
                <label class="block text-lg font-semibold text-gray-700 font-gotham">Address</label>
                <input id="user-address" type="text" name="address"
                    class="w-full border border-gray-300 p-3 rounded-md font-brandon"
                    value="{{ old('address', $restaurant->address) }}">
            </div>

            <div class="mb-6">
                <label class="block text-lg font-semibold text-gray-700 font-gotham">City</label>
                <input id="user-city" type="text" name="city"
                    class="w-full border border-gray-300 p-3 rounded-md font-brandon"
                    value="{{ old('city', $restaurant->city) }}">
            </div>

            <div class="mb-6">
                <label class="block text-lg font-semibold text-gray-700 font-gotham">Contact</label>
                <input id="user-contact" type="text" name="contact"
                    class="w-full border border-gray-300 p-3 rounded-md font-brandon"
                    value="{{ old('contact', $restaurant->contact) }}">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-ijo text-white px-6 py-3 rounded-md hover:bg-teal font-semibold">SAVE</button>
            </div>

        </form>


    </main>

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

    <script>
        // Hamburger menu toggle functionality
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const menu = document.getElementById('menu');

        hamburgerBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden'); // Show or hide the menu
        });

        // Function to get query parameters
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        // Fetch user data from an API or local data (simulate for now)
        function fetchUserData(userId) {
            // Simulated database (replace with actual API fetch)
            const users = {
                "R0001": {
                    name: 'RESTO 1',
                    email: 'RESTO1@gmail.com',
                    address: 'jl. 1',
                    city: 'a',
                    contact: '01910192'
                },
                "R0002": {
                    name: 'RESTO2',
                    email: 'RESTO2@gmail.com',
                    address: 'jl. 2',
                    city: 'b',
                    contact: '01910192'
                },
                "R0003": {
                    name: 'RESTO3',
                    email: 'RESTO3@gmail.com',
                    address: 'jl. 3',
                    city: 'c',
                    contact: '01910192'
                }
            };

            return users[userId] || {
                name: "Unknown",
                email: "Unknown",
                address: "Unknown",
                city: "Unknown",
                contact: "Unknown",
            };
        }

        // Main function to update form fields dynamically
        // Remove the fetchUserData function if using real data from the database
        function loadUserInfo() {
            const userId = "{{ $restaurant->id }}"; // Get the restaurant ID passed from the controller
            if (!userId) {
                alert("User ID not found!");
                return;
            }

            // Populate the form with the actual data
            document.getElementById("user-id").value = userId;
            document.getElementById("user-name").value = "{{ $restaurant->name }}";
            document.getElementById("user-email").value = "{{ $restaurant->email }}";
            document.getElementById("user-address").value = "{{ $restaurant->address }}";
            document.getElementById("user-city").value = "{{ $restaurant->city }}";
            document.getElementById("user-contact").value = "{{ $restaurant->contact }}";
        }

        // Call function on page load
        window.onload = loadUserInfo;
    </script>

</body>

</html>
