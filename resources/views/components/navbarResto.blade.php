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
                <li><a href="dashboardResto" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Dashboard</a>
                </li>
                <li><a href="OrderListRestaurant" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Orders</a>
                </li>
                <li><a href="/products" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100">Menu</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('restaurant.logout') }}" class="inline">
                        @csrf
                        <a href="#" class="block px-6 py-3 hover:text-Teal hover:bg-gray-100" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </li>
                
                {{-- <li>
                    <form method="POST" action="{{'restaurant.logout'}}">
                        @csrf

                        <x-responsive-nav-link :href="route('restaurant.logout')" onclick="event.preventDefault() this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </li> --}}

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
