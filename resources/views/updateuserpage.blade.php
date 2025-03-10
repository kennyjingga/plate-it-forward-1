<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #menu {
            background-color: #F9F3F0 !important;
            opacity: 1 !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F9F3F0] font-sans pt-20 min-h-full">

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

    <main class="w-[90%] mx-auto mt-24 p-7 bg-[#F9F3F0] rounded-lg relative">
        <a href="/userinfo" class="absolute -top-10 left-0 text-[#00615F] font-semibold hover:underline">← Back</a>
        <h1 class="text-3xl font-bold text-[#00615F]">User’s Information</h1>

        <form class="mt-4">
            <div class="mb-4">
                <label class="block text-lg font-semibold text-gray-700">User ID</label>
                <input id="user-id" type="text" class="w-full border border-gray-300 p-3 rounded-md bg-gray-100"
                    readonly>
            </div>

            <div class="mb-4">
                <label class="block text-lg font-semibold text-gray-700">Name</label>
                <input id="user-name" type="text" class="w-full border border-gray-300 p-3 rounded-md">
            </div>

            <div class="mb-6">
                <label class="block text-lg font-semibold text-gray-700">E-mail</label>
                <input id="user-email" type="email" class="w-full border border-gray-300 p-3 rounded-md">
            </div>

            <div class="flex justify-end">
                <button class="bg-[#00615F] text-white px-6 py-3 rounded-md hover:bg-teal font-semibold"><a
                        href="/userinfo">SAVE</a></button>
            </div>
        </form>
    </main>
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
                "US001": {
                    name: "Ashahra Aprilia Puspaanggraini",
                    email: "ashahraaprilia@gmail.com"
                },
                "US002": {
                    name: "John Doe",
                    email: "johndoe@gmail.com"
                },
                "US003": {
                    name: "Jane Smith",
                    email: "janesmith@gmail.com"
                }
            };

            return users[userId] || {
                name: "Unknown",
                email: "Unknown"
            };
        }

        // Main function to update form fields dynamically
        function loadUserInfo() {
            const userId = getQueryParam("id");
            if (!userId) {
                alert("User ID not found!");
                return;
            }

            // Fetch user data
            const user = fetchUserData(userId);

            // Update form fields
            document.getElementById("user-id").value = userId;
            document.getElementById("user-name").value = user.name;
            document.getElementById("user-email").value = user.email;
        }

        // Call function on page load
        window.onload = loadUserInfo;
    </script>

</body>

</html>
