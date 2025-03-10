<x-html title="Sign In - Sign Up">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    @endpush
    <x-navbar></x-navbar>
    <div class="cont mt-200 font-gotham">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="{{ route('signin.post') }}" class="sign-in-form" method="POST">
                    @csrf
                    <img src="{{ asset('assets/Image/Logo copy.png') }}" class="w-40 h-40" alt="logo">
                    <h2 class="text-DefaultGreen text-5xl mb-10">Sign In</h2>
                    <div class="input-field input-pass w-8/12 bg-LightGreen">
                        <i class="fas fa-envelope"></i>
                        <input
                            class="text-DefaultWhite focus:text-DefaultWhite placeholder:text-DefaultWhite font-brandon"
                            type="email" placeholder="Email" id="email" name="email" required />
                        <p class="text-red-600 text-xs w-72" id="emailError"></p>
                    </div>
                    <div class="input-field w-8/12 bg-LightGreen">
                        <i class="fas fa-lock"></i>
                        <input class="font-brandon" type="password" placeholder="Password" id="pass"
                            name="password" required />
                        <p class="error-message" id="passError"></p>
                    </div>
                    <button type="submit"
                        class="font-gotham-bold bg-DefaultGreen text-DefaultWhite py-2 rounded-full font-bold text-lg transition-all duration-300 ease-in-out text-center mt-4 hover:bg-DefaultWhite hover:text-DefaultGreen cursor-pointer w-8/12">
                        Sign In
                    </button>

                </form>
                <form action="{{ route('signup') }}" class="sign-up-form" method="POST">
                    @csrf
                    <img src="{{ asset('assets/Image/Logo copy.png') }}" class="w-40 h-40" alt="logo">
                    <h2 class="text-DefaultGreen text-5xl mb-10">Sign Up</h2>
                    <div class="input-field w-8/12  bg-LightGreen">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Full Name" name="name" id="name" required />
                        <p class="error-message" id="nameError"></p>
                    </div>
                    <div class="input-field input-pass w-8/12  bg-LightGreen">
                        <i class="fas fa-envelope"></i>
                        <input class="text-DefaultWhite focus:text-DefaultWhite placeholder:text-DefaultWhite"
                            type="email" placeholder="Email" id="email" name="email" required />
                        <p class="error-message" id="emailError"></p>
                    </div>
                    <div class="input-field w-8/12 bg-LightGreen">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="pass" name="password" required />
                        <p class="error-message" id="passError"></p>
                    </div>
                    <button type="submit"
                        class="font-gotham-bold bg-DefaultGreen text-DefaultWhite py-2 rounded-full font-bold text-lg transition-all duration-300 ease-in-out text-center mt-4 hover:bg-DefaultWhite hover:text-DefaultGreen cursor-pointer w-8/12">
                        Sign Up
                    </button>

                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content pl-4 pr-8">
                    <h3 class="text-3xl mt-20">Serve Smiles, One Meal at a Time—Join Us!</h3>
                    <p class="font-brandon">Sign up today and be part of something bigger.</p>
                    <div class="font-gotham-bold w-6/12 bg-DefaultWhite text-DefaultGreen py-2 rounded-full font-bold text-lg transition-all duration-300 ease-in-out text-center mt-4 hover:bg-DefaultGreen hover:text-DefaultWhite cursor-pointer"
                        id="sign-up-btn">
                        Sign Up
                    </div>
                    <img src="{{ asset('assets/Image/5.png') }}" class="img-sign-in">
                </div>


            </div>
            <div class="panel right-panel">
                <div class="content text-center">
                    <h3 class="text-6xl mt-15">Registered?</h3>
                    <p>
                        Perfect! Let’s make kindness the new cool!
                    </p>
                    <div class="font-gotham-bold w-7/12 bg-DefaultWhite text-DefaultGreen py-2 rounded-full font-bold text-lg transition-all duration-300 ease-in-out text-center hover:bg-DefaultGreen hover:text-DefaultWhite cursor-pointer block mx-auto mt-4"
                        id="sign-in-btn">
                        Sign In
                    </div>
                    <img src="{{ asset('assets/Image/6.png') }}" class="img-sign-up">
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    {{-- @include('components.footer') --}}
    <x-footer></x-footer>

    <script src="{{ asset('js/signin.js') }}"></script>
</x-html>
