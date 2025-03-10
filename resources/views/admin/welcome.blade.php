<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center bg-white p-8 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Welcome, Admin</h1>
        <a href="{{ route('login.admin') }}" class="block bg-blue-500 text-white px-4 py-2 rounded">Login</a>
        <a href="{{ route('register.admin') }}" class="block bg-green-500 text-white px-4 py-2 rounded mt-2">Register</a>
    </div>
</body>

</html>
