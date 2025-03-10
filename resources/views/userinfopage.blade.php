<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link href="/css/tailwind.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        <style>.dropdown {
            display: none;
            position: absolute;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10;
            width: 150px;
        }

        .dropdown.active {
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
    </style>
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F9F3F0] text-gray-900 flex flex-col min-h-screen">

    <!-- Navbar -->
    <x-navbarAdmin></x-navbarAdmin>

    <!-- Main Content -->
    <div class="w-full pt-40 mx-auto py-8 flex-grow items-center font-brandon">
        <div class="w-11/12 mx-auto flex justify-between items-center">
            <h2 class="text-2xl font-bold text-DefaultGreen font-gotham">User’s Information</h2>
            <button id="delete-btn" onclick="handleTrashButton()" class="text-red-600 hover:text-red-800 text-xl">
                🗑️
            </button>
        </div>

        <div class="bg-white rounded-lg w-11/12 mx-auto shadow-md mt-4">
            <!-- Desktop Table -->
            <div class="hidden md:block">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr class="text-left text-gray-600">
                            <th class="p-3"></th>
                            <th class="p-3">User ID</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">E-mail</th>
                        </tr>
                    </thead>
                    <tbody id="userTable"></tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden space-y-4 p-4" id="userCards"></div>
        </div>
    </div>

    <script>
        let users = [{
                id: 'US001',
                name: 'Ashahra Aprilia Puspaanggraini',
                email: 'ashahraaprilia@gmail.com'
            },
            {
                id: 'US002',
                name: 'John Doe',
                email: 'johndoe@gmail.com'
            },
            {
                id: 'US003',
                name: 'Jane Smith',
                email: 'janesmith@gmail.com'
            }
        ];

        let deleteMode = false;

        function populateTable() {
            const tableBody = document.getElementById('userTable');
            const cardContainer = document.getElementById('userCards');

            tableBody.innerHTML = '';
            cardContainer.innerHTML = '';

            users.forEach((user) => {
                const row = document.createElement('tr');
                row.className = 'border-b hover:bg-gray-50';

                row.innerHTML = `
                    <td class="p-3 relative action-cell">
                        ${deleteMode 
                            ? `<input type='checkbox' class='delete-checkbox' data-id='${user.id}'>` 
                            : `<button class="dots-menu" onclick="toggleDropdown(this)">&#x22EE;</button>
                                               <div class="dropdown absolute left-4 w-40 mt-2 bg-white shadow-md rounded-md hidden">
                                                   <ul class="text-sm">
                                                       <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                                           <a href="/updateuserinfo?id=${user.id}">Update user information</a>
                                                       </li>
                                                       <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-600" onclick="confirmDeleteUser('${user.id}')">Delete user</li>
                                                   </ul>
                                               </div>`
                        }
                    </td>
                    <td class="p-3">${user.id}</td>
                    <td class="p-3">${user.name}</td>
                    <td class="p-3">${user.email}</td>
                `;
                tableBody.appendChild(row);

                // Mobile Card
                const card = document.createElement('div');
                card.className = "bg-white p-4 rounded-lg shadow-md";
                card.innerHTML = `
                    <div class="flex justify-between items-center p-3 rounded-lg bg-white">
                        <div>
                            <h3 class="text-lg font-bold text-green-800">${user.name}</h3>
                            <p class="text-gray-600"><strong>ID:</strong> ${user.id}</p>
                            <p class="text-gray-600"><strong>Email:</strong> ${user.email}</p>
                        </div>
                        <div class="relative">
                            ${deleteMode 
                                ? `<input type='checkbox' class='delete-checkbox' data-id='${user.id}'>` 
                                : `<button class="dots-menu" onclick="toggleDropdown(this)">&#x22EE;</button>
                                                <div class="dropdown absolute right-0 w-40 mt-2 bg-white shadow-md rounded-md hidden">
                                                    <ul class="text-sm">
                                                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                                           <a href="/updateuserinfo?id=${user.id}">Update user information</a>
                                                       </li>
                                                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-red-600" onclick="confirmDeleteUser('${user.id}')">Delete user</li>
                                                    </ul>
                                                </div>`
                            }
                        </div>
                    </div>
                `;

                cardContainer.appendChild(card);
            });
        }

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
    </script>
</body>

</html>
