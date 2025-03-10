<x-html>

    <body class="bg-DefaultWhite">

        @if (Auth::check())
            <x-navbarAfterLogin></x-navbarAfterLogin>
        @else
            <x-navbar></x-navbar>
        @endif
        <div class="relative">
            <img src="{{ asset('assets/Image/panti1.png') }}" alt="Background"
                class="grayscale inset-0 w-full h-[89vh] object-cover">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-DefaultGreen bg-opacity-50"></div>

            <!-- Text Content -->
            <div class="absolute inset-0 container mx-auto flex flex-col items-start justify-center px-6 lg:px-12">
                <h1 class="text-DefaultWhite text-4xl lg:text-7xl font-gotham leading-tight">
                    Plate It Forward.
                </h1>
                <h2 class="text-DefaultWhite text-opacity-50 text-4xl lg:text-7xl font-gotham mt-2 lg:mt-6">
                    Nourish Communities, <br> Reduce Waste
                </h2>
                <p class="text-DefaultWhite text-l lg:text-2xl mt-3 lg:mt-6 max-w-3xl font-brandon">
                    Plate It Forward is a food waste management initiative dedicated to rescuing surplus food and
                    redistributing
                    it to those in need, creating a sustainable cycle of nourishment and hope.
                </p>
            </div>
        </div>


        <div class="bg-DefaultWhite py-12 lg:py-16 h-100 ">
            <div
                class="container mx-auto px-6 lg:px-12 flex flex-col lg:flex-row items-center lg:items-start space-y-8 lg:space-y-0 lg:space-x-12">
                <!-- Image Section -->
                <div class="flex-shrink-0 w-full lg:w-1/2 h-full">
                    <img src="{{ asset('assets/Image/anak.jpg') }}" alt="Kids Smiling"
                        class="rounded-t-lg object-cover w-full h-auto">
                    <div class="bg-DefaultGreen bg-opacity-30 text-black text-center p-4 rounded-b-lg mt-0">
                        <p class="font-medium text-lg opacity-60">
                            Uniting with foundations and orphanages, where every act of help creates a ripple of hope in
                            their little hearts and minds.
                        </p>
                    </div>
                </div>

                <!-- Text Section -->
                <div class="w-full lg:w-1/2 h-full">
                    <div class="flex flex-col justify-between">
                        <div>
                            <p class="text-Teal uppercase font-semibold tracking-wide">Our Purpose</p>
                            <h2 class="text-3xl lg:text-5xl font-bold mt-2">
                                Compassion starts with each of us.
                            </h2>
                            <p class="text-gray-600 text-lg mt-4 leading-relaxed">
                                Every individual has the power to create a kinder world through small, meaningful
                                actions.
                                It
                                begins
                                with empathy, understanding, and a willingness to make a difference.
                            </p>
                        </div>
                        <div>
                            <button
                                class="mt-6 bg-Teal text-DefaultWhite font-medium py-3 px-6 rounded-full hover:bg-TealLight transition">
                                Learn More
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6 lg:px-12 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:gap-20 md:gap-10 gap-20 lg:grid-cols-4 place-items-center">
                <!-- Card 1 -->
                <div class="relative bg-white p-6 bg-cover bg-center rounded-lg shadow-lg hover:shadow-xl w-60 h-[40vh] group"
                    style="background-image: url('assets/Image/anak1.jpg');">
                    <!-- Overlay -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 rounded-lg transition duration-300 group-hover:bg-teal-700 group-hover:bg-opacity-90">
                    </div>

                    <!-- Content -->
                    <div class="relative mt-8 mb-20 text-center z-10">
                        <h2 class="text-4xl font-bold text-white">We Empower</h2>
                        <p class="text-base text-gray-200 mt-2">
                            Giving others the strength and confidence to take action.
                        </p>
                    </div>

                    <!-- Icon Circle -->
                    <div
                        class="absolute bottom-[-70px] left-1/2 transform -translate-x-1/2 bg-teal-700 w-32 h-32 rounded-full flex items-center justify-center z-20 transition duration-300 group-hover:bg-black">
                        <div class="text-white text-lg">
                            <svg fill="white" width="80" height="80" viewBox="0 0 256 256"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M152,48a16.01833,16.01833,0,0,1,16,16V80H136V64A16.01833,16.01833,0,0,1,152,48ZM88,64a16,16,0,0,1,32,0v40a16,16,0,0,1-32,0V64ZM40,88a16,16,0,0,1,32,0v16a16,16,0,0,1-32,0Zm88,128a88.10627,88.10627,0,0,1-87.9209-84.249A31.94065,31.94065,0,0,0,80,125.13208a31.92587,31.92587,0,0,0,44.58057,3.34595,32.23527,32.23527,0,0,0,11.79443,11.4414A47.906,47.906,0,0,0,120,176a8,8,0,0,0,16,0,32.03635,32.03635,0,0,1,32-32,8,8,0,0,0,0-16H152a16.01833,16.01833,0,0,1-16-16V96h64a16.01833,16.01833,0,0,1,16,16v16A88.09957,88.09957,0,0,1,128,216Z" />
                            </svg>
                        </div>
                    </div>

                </div>


                <!-- Card 2 -->
                <div class="relative bg-white p-6 bg-cover bg-center rounded-lg shadow-lg hover:shadow-xl w-60 h-[40vh] group"
                    style="background-image: url('assets/Image/anak1(2).jpg');">
                    <!-- Overlay -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 rounded-lg transition duration-300 group-hover:bg-teal-700 group-hover:bg-opacity-90">
                    </div>

                    <!-- Content -->
                    <div class="relative mt-8 mb-20 text-center z-10">
                        <h2 class="text-4xl font-bold text-white">We Inspire</h2>
                        <p class="text-base text-gray-200 mt-2">
                            Sparking motivation and creativity to drive meaningful change.
                        </p>
                    </div>

                    <!-- Icon Circle -->
                    <div
                        class="absolute bottom-[-70px] left-1/2 transform -translate-x-1/2 bg-teal-700 w-32 h-32 rounded-full flex items-center justify-center z-20 transition duration-300 group-hover:bg-black">
                        <div class="text-white text-lg">
                            <svg fill="white" width="80" height="80" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 3V4M12 20V21M4 12H3M6.31412 6.31412L5.5 5.5M17.6859 6.31412L18.5 5.5M6.31412 17.69L5.5 18.5001M17.6859 17.69L18.5 18.5001M21 12H20M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                    stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>


                        </div>
                    </div>

                </div>


                <!-- Card 3 -->
                <div class="relative bg-white p-6 bg-cover bg-center rounded-lg shadow-lg hover:shadow-xl w-60 h-[40vh] group"
                    style="background-image: url('assets/Image/anak2.jpg');">
                    <!-- Overlay -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 rounded-lg transition duration-300 group-hover:bg-teal-700 group-hover:bg-opacity-90">
                    </div>

                    <!-- Content -->
                    <div class="relative mt-8 mb-20 text-center z-10">
                        <h2 class="text-4xl font-bold text-white">We Uplift</h2>
                        <p class="text-base text-gray-200 mt-2">
                            Lifting spirits and encouraging positivity in others.
                        </p>
                    </div>

                    <!-- Icon Circle -->
                    <div
                        class="absolute bottom-[-70px] left-1/2 transform -translate-x-1/2 bg-teal-700 w-32 h-32 rounded-full flex items-center justify-center z-20 transition duration-300 group-hover:bg-black">
                        <div class="text-white text-lg">
                            <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                            <svg fill="white" width="80" height="80" viewBox="-1.5 0 19 19"
                                xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                <path
                                    d="m12.358 10.753.153.151.53.53a.808.808 0 0 1 .193.274.653.653 0 0 1 .05.23.34.34 0 0 1-.04.17.49.49 0 0 1-.066.096l-.236.236a.4.4 0 0 1-.254.137.477.477 0 0 1-.23-.043.721.721 0 0 1-.183-.122 3.788 3.788 0 0 1-.109-.102l-.748-.763a.195.195 0 0 0-.281-.01l-.033.038a.237.237 0 0 0-.002.336l.89.871a.786.786 0 0 1 .175.237.52.52 0 0 1 .056.218.347.347 0 0 1-.04.17.578.578 0 0 1-.09.122l-.298.298a.438.438 0 0 1-.24.14.426.426 0 0 1-.217-.025.58.58 0 0 1-.183-.115 4.039 4.039 0 0 1-.13-.125l-.924-.941a.172.172 0 0 0-.25-.005l-.086.087a.19.19 0 0 0 .002.266l.852.834a1.032 1.032 0 0 1 .202.264.514.514 0 0 1 .06.22.345.345 0 0 1-.04.172.568.568 0 0 1-.091.12l-.236.237q-.336.298-.77-.137l-.884-.864a.121.121 0 0 0-.17-.002l-.116.094a.178.178 0 0 0 .004.26l.58.585a.578.578 0 0 1 .171.27.497.497 0 0 1 .003.227.463.463 0 0 1-.105.205l-.236.236a.406.406 0 0 1-.258.121.607.607 0 0 1-.227-.034.624.624 0 0 1-.224-.15l-4.795-4.794a4.493 4.493 0 0 1-.624-.768 3.564 3.564 0 0 1-.37-.754 2.857 2.857 0 0 1-.148-.708 2.092 2.092 0 0 1 .043-.634l-.845-.845-.858-.808 3.382-3.435 1.77 1.805-.818.817-.018.02-.012.013a1.69 1.69 0 0 0-.36.624 1.592 1.592 0 0 0-.058.709 1.532 1.532 0 0 0 .46.885l.242.241.022.021.015.014a1.517 1.517 0 0 0 1.391.337 1.617 1.617 0 0 0 .756-.45L8.563 6.95l.392.394.004.007 3.397 3.398zm1.34-2.57a2.327 2.327 0 0 1 0 .35 2.837 2.837 0 0 1-.146.698 3.475 3.475 0 0 1-.36.737 3.893 3.893 0 0 1-.11.164l-.056-.054-4.127-4.133a.475.475 0 0 0-.672-.001L6.786 7.386a.69.69 0 0 1-.316.2.567.567 0 0 1-.273.006l-.005-.001a.577.577 0 0 1-.255-.135l-.234-.233a.61.61 0 0 1-.19-.342.652.652 0 0 1 .02-.291l.003-.007a.748.748 0 0 1 .161-.274l.003-.003 1.62-1.62a1.742 1.742 0 0 1 .598-.39 2.792 2.792 0 0 1 .708-.174 4.396 4.396 0 0 1 .496-.028 4.6 4.6 0 0 1 .252.007 8.82 8.82 0 0 1 1.325.174l1.249-1.248 3.367 3.367-1.59 1.589a.474.474 0 0 0-.026.2z" />
                            </svg>
                        </div>
                    </div>

                </div>


                <!-- Card 4 -->
                <div class="relative bg-white p-6 bg-cover bg-center rounded-lg shadow-lg hover:shadow-xl w-60 h-[40vh] group"
                    style="background-image: url('assets/Image/anak2(2).jpg');">
                    <!-- Overlay -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 rounded-lg transition duration-300 group-hover:bg-teal-700 group-hover:bg-opacity-90">
                    </div>

                    <!-- Content -->
                    <div class="relative mt-8 mb-20 text-center z-10">
                        <h2 class="text-4xl font-bold text-white">We Nourish</h2>
                        <p class="text-base text-gray-200 mt-2">
                            Fostering growth and well-being through care and support.
                        </p>
                    </div>
                    <div
                        class="absolute bottom-[-70px] left-1/2 transform -translate-x-1/2 bg-teal-700 w-32 h-32 rounded-full flex items-center justify-center z-20 transition duration-300 group-hover:bg-black">
                        <div class="text-white text-lg">
                            <svg width="80" height="80" viewBox="0 0 107 107" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="107" height="107" fill="none" />
                                <path
                                    d="M8.91675 98.0833V89.1667C8.91675 89.1667 31.2084 80.25 53.5001 80.25C75.7917 80.25 98.0834 89.1667 98.0834 89.1667V98.0833H8.91675ZM50.3792 40.5708C45.0292 23.1833 17.8334 27.1958 17.8334 27.1958C17.8334 27.1958 18.7251 61.9708 44.1376 56.6208C42.3542 43.6917 35.6667 40.125 35.6667 40.125C48.1501 40.125 49.0417 55.2833 49.0417 55.2833V75.7917H57.9584V57.0667C57.9584 57.0667 57.9584 39.6792 71.3334 35.2208C71.3334 35.2208 62.4167 48.5958 62.4167 57.5125C93.6251 60.6333 93.6251 17.8333 93.6251 17.8333C93.6251 17.8333 53.9459 13.375 50.3792 40.5708Z"
                                    fill="white" />
                            </svg>

                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="bg-DefaultWhite rounded-lg shadow-md overflow-hidden mx-auto max-w-6.7xl mt-40">
            <!-- Container Wrapper -->
            <div class="flex flex-col md:flex-row">
                <!-- Left Section: Map with Stats -->
                <div class="flex flex-col w-full md:w-3/5">
                    <!-- Map Image -->
                    <div class="relative">
                        <img src="{{ asset('assets/Image/map.jpg') }}" alt="World Map with Marker"
                            class="w-full h-auto">
                    </div>

                    <!-- Stats Section -->
                    <div class="bg-white px-6 py-8 md:px-10 md:py-10 space-y-6 md:space-y-8">
                        <!-- Meals Shared -->
                        <div class="flex justify-between items-center font-gotham">
                            <div class="text-black">
                                <p class="text-4xl font-bold">8,110 meals</p>
                                <p class="opacity-40">warmed up and filled tummies</p>
                            </div>
                            <div class="text-right text-DefaultGreen">
                                <p class="text-4xl font-bold">+270</p>
                                <p class="opacity-60">in the last day</p>
                            </div>
                        </div>
                        <!-- Supporters -->
                        <div class="flex justify-between items-center font-gotham">
                            <div class="text-black">
                                <p class="text-4xl font-bold">2,509 supporters</p>
                                <p class="opacity-40">uniting and fighting hunger together</p>
                            </div>
                            <div class="text-right text-DefaultGreen">
                                <p class="text-4xl font-bold">+34</p>
                                <p class="opacity-60">in the day</p>
                            </div>
                        </div>
                        <!-- Foundations Reached -->
                        <div class="flex justify-between items-center font-gotham">
                            <div class="text-black">
                                <p class="text-4xl font-bold">317 orphanages</p>
                                <p class="opacity-40">reached and became part of the family</p>
                            </div>
                            <div class="text-right text-DefaultGreen">
                                <p class="text-4xl font-bold">+4</p>
                                <p class="opacity-60">in the last 3 days</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section: Text -->
                <div
                    class="bg-[#2e645f] text-white p-8 md:p-10 flex flex-col justify-center w-full md:w-2/5 font-gotham">
                    <h2 class="text-6xl font-bold mb-16">Our impact to date</h2>
                    <p class="text-lg leading-relaxed opacity-80 font-brandon">
                        Plate It Forward has made a meaningful difference by distributing meals to foundations and
                        orphanages in
                        need. Through partnerships with generous restaurants, we’ve created a sustainable system that
                        provides
                        nourishment, turning compassion into lasting positive change.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-DefaultWhite py-10">
            <div class="carousel-container max-w-4xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-8 mt-14">
                    <h2 class="text-6xl font-gotham text-gray-800">Share the love</h2>
                    <p class="text-gray-600 text-2xl font-brandon">See how Plate It Forward and your support have
                        helped
                        those in need!</p>
                </div>

                <!-- Carousel -->
                <div class="relative overflow-hidden bg-white rounded-lg shadow-md">
                    <div id="carousel-items" class="flex transition-transform duration-500">
                        <!-- Carousel Item 1 -->
                        <div
                            class="w-full flex-shrink-0 flex md:flex-row flex-col items-center justify-center p-24 font-gotham space-y-6 md:space-y-0 md:space-x-8">
                            <div class="mb-6 md:mb-0">
                                <img src="{{ asset('assets/Image/rev1.jpeg') }}" alt="User photo"
                                    class="w-70 h-70 md:w-70 md:h-70 rounded-lg object-cover" />
                            </div>
                            <div>
                                <blockquote class="text-gray-800 text-lg font-medium mb-2">
                                    "Kakak-kakak memberikan kami makanan yang tidak hanya mengenyangkan, tapi juga penuh
                                    dengan kebaikan dari orang-orang yang peduli."
                                </blockquote>
                                <p class="text-gray-500">Tomas Roharini - 12 tahun</p>
                            </div>
                        </div>

                        <!-- Carousel Item 2 -->
                        <div
                            class="w-full flex-shrink-0 flex md:flex-row flex-col items-center justify-center p-24 space-y-6 md:space-y-0 md:space-x-8">
                            <div class="mb-6 md:mb-0">
                                <img src="{{ asset('assets/Image/rev2.png') }}" alt="User photo"
                                    class="w-100 h-100 md:w-100 md:h-100 rounded-lg object-cover" />
                            </div>
                            <div>
                                <blockquote class="text-gray-800 text-lg font-medium mb-2">
                                    "Kami merasa dihargai dan tidak lagi merasa kelaparan, karena makanan yang dibagikan
                                    selalu tepat waktu dan berkualitas!"
                                </blockquote>
                                <p class="text-gray-500">Dina Sulyaningsih - 14 tahun</p>
                            </div>
                        </div>

                        <!-- Carousel Item 3 -->
                        <div
                            class="w-full flex-shrink-0 flex md:flex-row flex-col items-center justify-center p-24 space-y-6 md:space-y-0 md:space-x-8">
                            <div class="mb-6 md:mb-0">
                                <img src="{{ asset('assets/Image/rev3.jpeg') }}" alt="User photo"
                                    class="w-70 h-70 md:w-70 md:h-70 rounded-lg object-cover" />
                            </div>
                            <div>
                                <blockquote class="text-gray-800 text-lg font-medium mb-2">
                                    "Kami sangat bersyukur atas bantuan Plate It Forward yang membuat hidup kami lebih
                                    baik dengan memberikan makanan yang kami butuhkan setiap hari."
                                </blockquote>
                                <p class="text-gray-500">Sri Odetta - 9 tahun</p>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Arrows -->
                    <button id="prev-btn"
                        class="absolute top-1/2 left-6 -translate-y-1/2 bg-gray-800 text-white p-3 rounded-full hover:bg-gray-700 focus:outline-none shadow-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="next-btn"
                        class="absolute top-1/2 right-6 -translate-y-1/2 bg-gray-800 text-white p-3 rounded-full hover:bg-gray-700 focus:outline-none shadow-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <!-- Indicators -->
                <div class="flex justify-center space-x-2 mt-4">
                    <button class="w-3 h-3 bg-gray-400 rounded-full focus:outline-none" data-slide="0"></button>
                    <button class="w-3 h-3 bg-gray-400 rounded-full focus:outline-none" data-slide="1"></button>
                    <button class="w-3 h-3 bg-gray-400 rounded-full focus:outline-none" data-slide="2"></button>
                </div>
            </div>

            <script>
                const carouselItems = document.getElementById("carousel-items");
                const prevBtn = document.getElementById("prev-btn");
                const nextBtn = document.getElementById("next-btn");
                const indicators = document.querySelectorAll("[data-slide]");

                let currentIndex = 0;
                const totalItems = indicators.length;

                // Function to update carousel position and active indicator
                const updateCarousel = () => {
                    carouselItems.style.transform = `translateX(-${currentIndex * 100}%)`;
                    indicators.forEach((indicator, index) => {
                        indicator.classList.toggle("bg-gray-800", index === currentIndex);
                        indicator.classList.toggle("bg-gray-400", index !== currentIndex);
                    });
                };

                // Navigate to the previous item
                prevBtn.addEventListener("click", () => {
                    currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                    updateCarousel();
                });

                // Navigate to the next item
                nextBtn.addEventListener("click", () => {
                    currentIndex = (currentIndex + 1) % totalItems;
                    updateCarousel();
                });

                // Navigate to a specific item when indicator is clicked
                indicators.forEach((indicator, index) => {
                    indicator.addEventListener("click", () => {
                        currentIndex = index;
                        updateCarousel();
                    });
                });

                // Initialize the carousel
                updateCarousel();
            </script>
        </div>



        <div class="flex items-center justify-center h-[70vh]">
            <div class="flex items-center bg-white p-10 rounded-lg shadow-md max-w-3xl">
                <!-- Left: Illustration -->
                <div class="w-1/2 flex justify-center items-center">
                    <img src="{{ asset('assets/Image/envelope.png') }}" alt="Illustration" class="w-100 h-70" />
                </div>

                <!-- Right: Text and Form -->
                <div class="w-1/2 text-left pl-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Got a taste for fighting hunger?</h2>
                    <p class="text-gray-600 mb-4">Connect with your impact by signing up for our newsletter.</p>
                    <form class="flex items-center">
                        <input type="email" placeholder="Enter your email"
                            class="border border-gray-300 rounded-l-md px-4 py-2 w-full focus:outline-none focus:ring focus:ring-blue-300"
                            required />
                        <button type="submit"
                            class="bg-yellow-400 flex items-center justify-center px-4 py-2 rounded-r-md hover:bg-yellow-500 focus:outline-none focus:ring focus:ring-yellow-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="white" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <x-footer></x-footer>

    </body>
</x-html>
