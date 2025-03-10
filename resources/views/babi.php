<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Information</title>
    <link href="/css/tailwind.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-DefaultWhite">
    <x-navbarAdmin></x-navbarAdmin>

    <!-- Main Content -->
    <div class="w-full pt-40 mx-auto py-8 flex-grow items-center">
        <div class="w-11/12 mx-auto flex justify-between items-center">
            {{-- <h2 class="text-2xl font-bold text-DefaultGreen font-gotham">Restaurant's Information</h2> --}}
            <div class="w-11/12 mx-auto flex justify-between items-center">
                <!-- Left aligned Restaurant's Information -->
                <h2 class="text-2xl font-bold text-DefaultGreen font-gotham">Restaurant's Information</h2>

                <!-- Right aligned buttons side by side -->
                <div class="flex justify-end items-center space-x-4">
                    <button id="addOrphanageBtn"
                        class="bg-green-600 text-white py-2 px-6 rounded-md hover:bg-green-700 focus:outline-none">
                        Add Restaurant
                    </button>

                    <button id="delete-btn" onclick="handleTrashButton()"
                        class="text-red-600 hover:text-red-800 text-xl">
                        🗑️
                    </button>
                </div>
            </div>

            <!-- Add Restaurant Modal -->
            <div id="addOrphanageModal"
                class="modal hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-md w-96 shadow-lg">
                    <h3 class="text-xl font-semibold text-green-800 mb-4">Add New Restaurant</h3>
                    <form method="POST" action="{{ route('restaurant.register') }}" id="addOrphanageForm">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                :value="old('address')" required autocomplete="address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- City -->
                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                :value="old('city')" required autocomplete="city" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <!-- Contact -->
                        <div>
                            <x-input-label for="contact" :value="__('Contact')" />
                            <x-text-input id="contact" class="block mt-1 w-full" type="text" name="contact"
                                :value="old('contact')" required autocomplete="contact" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">


                            <x-primary-button class="ms-4">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg w-11/12 mx-auto shadow-md mt-4">
            <!-- Desktop Table -->
            <div class="hidden md:block">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr class="text-left text-gray-600 font-gotham">
                            <th class="p-3"></th>
                            <th class="p-3">Resto ID</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">E-mail</th>
                            <th class="p-3">Address</th>
                            <th class="p-3">City</th>
                            <th class="p-3">Contact</th>
                        </tr>
                    </thead>
                    <tbody id="userTable" class="font-brandon"></tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden space-y-4 p-4" id="userCards"></div>
        </div>
    </div>
    <script>
        // Buka modal
        document.getElementById('addOrphanageBtn').addEventListener('click', function() {
            document.getElementById('addOrphanageModal').classList.remove('hidden');
        });

        // Tutup modal
        function closeModal() {
            document.getElementById('addOrphanageModal').classList.add('hidden');
        }

        // Menangani pengiriman form
        // Handle form submission
        document.getElementById('addOrphanageForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const name = document.getElementById('restaurantName').value;
            const email = document.getElementById('restaurantEmail').value;
            const address = document.getElementById('restaurantAddress').value;
            const city = document.getElementById('restaurantCity').value;
            const contact = document.getElementById('restaurantContact').value;
            const id = `R${String(users.length + 1).padStart(4, '0')}`; // Auto-generate ID

            // Add the new restaurant to the array
            users.push({
                id: id,
                name: name,
                email: email,
                address: address,
                city: city,
                contact: contact
            });

            // Close the modal
            closeModal();

            // Refresh the table and cards
            populateTable();
        });
    </script>



    <script>
        let users = [{
                id: 'R0001',
                name: 'RESTO 1',
                email: 'RESTO1@gmail.com',
                address: 'jl. 1',
                city: 'a',
                contact: '01910192'
            },
            {
                id: 'R0002',
                name: 'RESTO2',
                email: 'RESTO2@gmail.com',
                address: 'jl. 2',
                city: 'b',
                contact: '01910192'
            },
            {
                id: 'R0003',
                name: 'RESTO3',
                email: 'RESTO3@gmail.com',
                address: 'jl. 3',
                city: 'c',
                contact: '01910192'
            }
        ];

        let deleteMode = false;
        async function populateTable() {
            try {
                const response = await fetch('/api/restaurants');
                if (!response.ok) throw new Error('Failed to fetch data');

                const users = await response.json();
                const tableBody = document.getElementById('userTable');

                tableBody.innerHTML = '';

                users.forEach((user) => {
                    const row = `
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">${user.id}</td>
                    <td class="p-3">${user.name}</td>
                    <td class="p-3">${user.email}</td>
                    <td class="p-3">${user.address}</td>
                    <td class="p-3">${user.city}</td>
                    <td class="p-3">${user.contact}</td>
                </tr>`;
                    tableBody.innerHTML += row;
                });
            } catch (error) {
                console.error('Error fetching restaurant data:', error);
            }
        }

        document.addEventListener("DOMContentLoaded", populateTable);


        function handleTrashButton() {
            if (!deleteMode) {
                toggleDeleteMode();
            } else {
                deleteSelectedUsers();
            }
        }

        function toggleDeleteMode() {
            deleteMode = true;
            populateTable();
            document.getElementById("delete-btn").classList.add("text-red-800");
        }

        function deleteSelectedUsers() {
            let checkboxes = document.querySelectorAll(".delete-checkbox:checked");

            if (checkboxes.length === 0) {
                alert("No users selected for deletion.");
                exitDeleteMode();
                return;
            }

            if (confirm("Are you sure you want to delete selected users?")) {
                let idsToDelete = Array.from(checkboxes).map(checkbox => checkbox.dataset.id);

                users = users.filter(user => !idsToDelete.includes(user.id));

                alert("Selected users have been deleted successfully!");
            }

            exitDeleteMode();
        }

        function exitDeleteMode() {
            deleteMode = false;
            document.getElementById("delete-btn").classList.remove("text-red-800");
            populateTable();
        }

        function toggleDropdown(button) {
            let dropdown = button.nextElementSibling;
            document.querySelectorAll(".dropdown").forEach(el => el.classList.add("hidden"));
            dropdown.classList.toggle("hidden");
        }

        function confirmDeleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                users = users.filter(user => user.id !== userId);
                populateTable();
                alert("User deleted successfully!");
            }
        }

        document.addEventListener("click", function(e) {
            if (!e.target.closest(".dots-menu") && !e.target.closest(".dropdown")) {
                document.querySelectorAll(".dropdown").forEach(el => el.classList.add("hidden"));
            }
        });

        populateTable();

        // Hamburger menu toggle functionality
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const menu = document.getElementById('menu');

        hamburgerBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden'); // Show or hide the menu
        });

        document.addEventListener("DOMContentLoaded", populateTable);
    </script>
</body>

</html>
