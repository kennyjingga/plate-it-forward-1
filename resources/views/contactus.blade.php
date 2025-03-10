<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-\u2026." crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

</head>

<!-- Menggunakan flex-col untuk menata konten dan footer -->

<body class="bg-[#F9F3F0] flex flex-col min-h-screen">
    @include('components.navbar')
    <!-- Kontainer Utama -->
    <main class="flex-grow flex justify-center items-center p-4 mt-28 mb-12"> <!-- Tambahkan mt-12 di sini -->
        <div class="bg-[#ECE6E6] w-full max-w-3xl rounded-lg shadow-md p-8">
            <!-- Judul -->
            <h1 class="font-gotham text-center text-[#00615F] text-4xl font-gotham-bold mb-6">LET'S CONNECT</h1>
            <div class=" h-[5px] bg-[#00615F] mb-4"></div>

            <!-- Deskripsi -->
            <p class="text-center text-gray-700 font-brandon mb-8">
                Fill out the form below with your inquiry, and we’ll get back to you within 24-48 hours, or you can call
                us
                directly at
                <strong class="text-[#00615F]">021-12345678</strong> or email us at
                <strong class="text-[#00615F]">plateitforward@gmail.com</strong> between the hours of 9 am - 5 pm IWST.
            </p>

            <!-- Form -->
            <form action="{{ route('contactus') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nama -->
                <div>
                    <input type="text" name="name" id="name"
                        class="text-DefaultGreen font-brandon w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00615F] bg-[#F9F3F0]"
                        placeholder="*Your Name..." value="{{ old('name') }}" required>
                    @error('name')
                        <span class="font-brandon text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <input type="email" name="email" id="email"
                        class="text-DefaultGreen font-brandon w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00615F] bg-[#F9F3F0]"
                        placeholder="*Your E-mail Address..." value="{{ old('email') }}" required>
                    @error('email')
                        <span class="font-brandon text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Informasi Tambahan -->
                <div>
                    <textarea name="additional_info" id="additional_info" rows="4"
                        class="text-DefaultGreen font-brandon w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00615F] bg-[#F9F3F0]"
                        placeholder="*Additional Info...">{{ old('additional_info') }}</textarea>
                    @error('additional_info')
                        <span class="font-brandon text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button type="submit"
                        class="font-gotham w-full bg-[#00615F] text-white py-3 rounded-lg font-bold text-lg hover:bg-[#F9F3F0] hover:text-[#00615F] transition duration-300 ease-in-out">
                        SUBMIT
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    @include('components.footer')

</body>

</html>
