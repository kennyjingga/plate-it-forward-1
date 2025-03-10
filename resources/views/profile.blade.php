<x-html>

    <body class="bg-DefaultGreen"> <!-- Adjusted padding top -->
        <x-navbar></x-navbar>
        <div class="flex items-center justify-center min-h-screen pt-24">
            <div class="bg-DefaultWhite shadow-md rounded-lg w-full max-w-3xl p-6">
                <div class="text-center">
                    <div class="relative w-24 h-24 mx-auto">
                        <img src="https://via.placeholder.com/150" alt="Profile Picture"
                            class="w-full h-full rounded-full object-cover">
                        <button
                            class="absolute bottom-0 right-0 bg-DefaultGreen text-DefaultWhite p-2 rounded-full hover:bg-teal-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M17.707 2.293a1 1 0 00-1.414 0L6.414 12.172l-.707.707L5 15l2.121-.707.707-.707L17.707 3.707a1 1 0 000-1.414z" />
                            </svg>
                        </button>
                    </div>
                    <h1 class="text-xl font-semibold mt-4">Sabrina Aryan</h1>
                    <p class="text-gray-600">SabrinaAry208@gmail.com</p>
                </div>

                <form class="mt-6 space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name" value="Sabrina Aryan"
                            class="mt-1 block bg-DefaultWhite w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>

                    <!-- Email is now uneditable -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="SabrinaAry208@gmail.com" readonly
                            class="mt-1 block bg-DefaultWhite w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>

                    <!-- Add Old Password field -->
                    <div>
                        <label for="old-password" class="block text-sm font-medium text-gray-700">Old Password</label>
                        <input type="password" id="old-password" name="old-password"
                            placeholder="Enter your old password"
                            class="mt-1 block bg-DefaultWhite w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter new password"
                            class="mt-1 block bg-DefaultWhite w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input type="password" id="confirm-password" name="confirm-password"
                            placeholder="Confirm new password"
                            class="mt-1 block bg-DefaultWhite w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-800"
                            onclick="confirm('Are you sure you want to delete your account?')">Delete Account</button>
                        <button type="button"
                            class="bg-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-400">Sign
                            Out</button>
                    </div>

                    <div class="text-right">
                        <button type="submit"
                            class="bg-teal-500 text-white py-2 px-4 rounded-md hover:bg-teal-600">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>



        <script>
            document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault();

                const oldPassword = document.getElementById('old-password').value;
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirm-password').value;

                // Set the correct old password (this could be dynamically set in a real application)
                const correctOldPassword = 'old_password_here'; // Replace with the actual old password from your system

                // Check if the old password matches
                if (oldPassword !== correctOldPassword) {
                    alert('Old password is incorrect!');
                    return;
                }

                // Check if new passwords match
                if (password !== confirmPassword) {
                    alert('Passwords do not match!');
                    return;
                }

                alert('Profile updated successfully!');
            });
        </script>
    </body>
</x-html>
