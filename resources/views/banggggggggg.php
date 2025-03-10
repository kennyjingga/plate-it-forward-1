<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Information</title>
    <link href="/css/tailwind.css" rel="stylesheet">

    <style>
        <style>.dropdown {
            position: absolute;
            left: 0;
            /* Align to the left of the parent */
            top: 100%;
            /* Position it directly below the button */
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 500;
            width: 150px;
            display: none;
        }

        #addOrphanageModal {
            z-index: 1000;
        }


        .dropdown.active {
            display: block;
        }

        .dropdown.hidden {
            display: none;
        }

        .dropdown:not(.hidden) {
            display: block;
        }

        .hidden-checkbox {
            display: none;
        }

        /* Style for the checkbox */
        .delete-checkbox {
            width: 18px;
            /* Set the width */
            height: 18px;
            /* Set the height */
        }

        #menu {
            background-color: #F9F3F0 !important;
            opacity: 1 !important;
        }

        /* Style for the checkbox */
        .delete-checkbox {
            width: 18px;
            /* Set the width */
            height: 18px;
            /* Set the height */
        }

        table {
            overflow: visible;
            width: 100%;
            /* Adjust the percentage to suit your needs */
            margin: 0 auto;
            /* Center the table */
        }

        table th:nth-child(3),
        /* Target the Email column header (3rd column) */
        table td:nth-child(3) {
            width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        table th:nth-child(2),
        /* Target the Email column header (3rd column) */
        table td:nth-child(2) {
            width: 70px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        table td:nth-child(4) {
            width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        table td:nth-child(5) {
            width: 270px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        table td:nth-child(6) {
            width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        table td:nth-child(7) {
            width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        table td:nth-child(1) {
            width: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-DefaultWhite">
    <x-navbarAdmin></x-navbarAdmin>

    <!-- Main Content -->
    <div class="w-full pt-40 mx-auto py-8 flex-grow items-center">

        <div class="w-11/12 mx-auto flex justify-between items-center">

            <div class="w-10/12 mx-auto flex justify-between items-center">
                <!-- Left aligned Restaurant's Information -->
                <h2 class="text-2xl font-bold text-DefaultGreen font-gotham">Orphanage's Information</h2>

                <!-- Right aligned buttons side by side -->
                <div class="flex justify-end items-center space-x-4">
                    <button id="addOrphanageBtn"
                        class="bg-green-600 text-white py-2 px-6 rounded-md hover:bg-green-700 focus:outline-none">
                        Add Orphanage
                    </button>
                </div>
            </div>

            <!-- Add Restaurant Modal -->
            <div id="addOrphanageModal"
                class="modal hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-md w-96 shadow-lg">
                    <h3 class="text-xl font-semibold text-green-800 mb-4">Add New Orphanage</h3>
                    <form method="POST" action="{{ route('panti.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
                            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="donation" :value="__('Donation')" />
                            <x-text-input id="donation" class="block mt-1 w-full" type="text" name="donation"
                                :value="old('donation')" required autocomplete="donation" />
                            <x-input-error :messages="$errors->get('donation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">


                            <x-primary-button class="ms-4">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <button onclick="closeModal()"
                        class="mt-4 bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">
                        Close
                    </button>

                </div>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg w-4/5 mx-auto shadow-md mt-4">
            <!-- Desktop Table -->
            <div class="md:block">
                <table class="relative">
                    <thead class="bg-gray-100">
                        <tr class="text-left text-gray-600 font-gotham">
                            <th class="p-3"></th>
                            <th class="p-3">ID</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Address</th>
                            <th class="p-3">City</th>
                            <th class="p-3">Contact</th>
                            <th class="p-3">Donation</th>
                            <th class="p-1"></th>
                        </tr>
                    </thead>

                    <tbody id="userTable" class="font-brandon">
                        @foreach ($orphanages as $orphanage)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 relative action-cell"></td>
                                <td class="p-3">{{ $orphanage->id }}</td>
                                <td class="p-3">{{ $orphanage->name }}</td>
                                <td class="p-3">{{ $orphanage->address }}</td>
                                <td class="p-3">{{ $orphanage->city }}</td>
                                <td class="p-3">{{ $orphanage->contact }}</td>
                                <td class="p-3">{{ $orphanage->donation }}</td>

                                <!-- Action column with three-dot menu -->
                                <td class="p-3 relative action-cell">
                                    <button class="dots-menu" onclick="toggleDropdown(this)">&#x22EE;</button>
                                    <div
                                        class="dropdown absolute left-0 top-0 w-40 mt-2 bg-white shadow-md rounded-md hidden z-10">
                                        <ul class="text-sm">
                                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                                <a href="{{ route('panti.edit', $orphanage->id) }}">Update
                                                    Orphanage Information</a>

                                            </li>

                                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-600">
                                                <form action="{{ route('panti.destroy', $orphanage->id) }}"
                                                    method="POST" id="deleteForm-{{ $orphanage->id }}"
                                                    onsubmit="return confirmDelete('{{ $orphanage->id }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full text-left">Delete
                                                        Orphanage</button>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <script>
        function confirmDelete(orphanageId) {
            if (confirm("Are you sure you want to delete this orphanage?")) {
                // If the user confirms, submit the form
                document.getElementById('deleteForm-' + restaurantId).submit();
            }
            return false; // Prevent default form submission until confirmed
        }

        let users = @json($restaurants);
        // Buka modal
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('addOrphanageBtn').addEventListener('click', function() {
                document.getElementById('addOrphanageModal').classList.remove('hidden');
            });
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

        function toggleDropdown(button) {
            // const dropdown = button.nextElementSibling; 
            event.stopPropagation(); // Prevents the click event from propagating to parent elements

            let dropdown = button.nextElementSibling; // Get the dropdown menu next to the button

            // Toggle visibility of the clicked dropdown
            dropdown.classList.toggle("hidden");

            // Hide all other dropdowns
            document.querySelectorAll(".dropdown").forEach(drop => {
                if (drop !== dropdown) {
                    drop.classList.add("hidden"); // Close other dropdowns
                }
            });

        }
    </script>

    <script>
        let deleteMode = false;

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

        function confirmDeleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                users = users.filter(user => user.id !== userId);
                populateTable();
                alert("User deleted successfully!");
            }
        }

        document.addEventListener("click", function(e) {
            if (!e.target.closest(".action-cell")) {
                document.querySelectorAll(".dropdown").forEach(el => el.classList.add("hidden"));
            }
        });


        // STARTTTTTTTTT
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
    </script>
</body>

</html>
