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
                <li><a href="/" class="block px-6 py-3 hover:text-DefaultGreen hover:bg-gray-100">Home</a></li>
                <li><a href="/restoranpage"
                        class="block px-6 py-3 hover:text-DefaultGreen hover:bg-gray-100">Restaurants</a>
                </li>
                <li><a href="/contact-us" class="block px-6 py-3 hover:text-DefaultGreen hover:bg-gray-100">Contact
                        Us</a></li>
                <li>
                    <a href="/login"
                        class="block px-6 py-3 text-white bg-DefaultGreen hover:bg-opacity-80 text-left">Sign
                        In</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<script>
    // Hamburger menu toggle functionality
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const menu = document.getElementById('menu');

    hamburgerBtn.addEventListener('click', () => {
        menu.classList.toggle('hidden'); // Show or hide the menu
    });
</script>
