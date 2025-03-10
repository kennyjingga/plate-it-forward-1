<x-guest-layout>
    <!-- Session Status -->

    <x-slot name="head">
        <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    </x-slot>

    {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

    <div class="cont mt-200">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="{{ route('login') }}" class="sign-in-form" method="POST">
                    @csrf
                    <img src="{{ asset('assets/Image/Logo copy.png') }}" class="w-40 h-40" alt="logo">
                    <h2 class="text-DefaultGreen text-5xl mb-10 font-gotham">Sign In</h2>
                    <div class="input-field input-pass w-8/12  bg-LightGreen font-brandon">
                        {{-- bg-LightGreen --}}
                        <i class="fas fa-envelope"></i>
                        <input class="focus:outline-none focus:ring-0" type="email" placeholder="Email" id="email"
                            name="email" :value="old('email')" autofocus autocomplete="off" required />
                        {{-- class="text-DefaultWhite focus:text-DefaultWhite placeholder:text-DefaultWhite"  --}}
                        <x-input-error :messages="$errors->login->get('email')" />
                    </div>
                    <div class="input-field w-8/12 bg-LightGreen font-brandon">
                        <i class="fas fa-lock"></i>
                        <input class="focus:outline-none focus:ring-0" type="password" placeholder="Password"
                            id="pass" name="password" autocomplete="off" required />
                        <x-input-error :messages="$errors->login->get('password')" />
                    </div>
                    <div class="flex items-center justify-end mt-4 md:w-96">
                        @if (Route::has('password.request'))
                            <a class="underline text-m text-gray-600 hover:text-gray-900 rounded-md focus:outline-none w-60 font-brandon"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <button type="submit"
                            class="font-gotham bg-DefaultGreen text-DefaultWhite py-2 rounded-full font-bold text-lg transition-all duration-300 ease-in-out text-center mt-4 hover:bg-[#F9F3F0] hover:text-[#00615F] cursor-pointer w-11/12 hover:outline hover:outline-[#00615F]">
                            {{ __('Sign In') }}
                        </button>
                    </div>


                </form>
                <form action="{{ route('register') }}" class="sign-up-form pb-5" method="POST">
                    @csrf
                    <img src="{{ asset('assets/Image/Logo copy.png') }}" class="w-40 h-40" alt="logo">
                    <h2 class="text-DefaultGreen text-5xl mb-10 font-gotham">Sign Up</h2>
                    <div class="input-field w-8/12  bg-LightGreen font-brandon">
                        <i class="fas fa-user"></i>
                        <input class="focus:outline-none focus:ring-0" type="text" placeholder="Full Name"
                            name="name-register" id="name-register" autofocus required />
                        <x-input-error :messages="$errors->register->get('name-register')" />
                    </div>
                    <div class="input-field input-pass w-8/12 bg-LightGreen font-brandon">
                        <i class="fas fa-envelope"></i>
                        <input class="focus:outline-none focus:ring-0" type="email" placeholder="Email"
                            id="email-register" name="email-register" :value="old('email')" required />
                        <x-input-error :messages="$errors->register->get('email-register')" />
                    </div>
                    <div class="input-field w-8/12 bg-LightGreen font-brandon">
                        <i class="fas fa-lock"></i>
                        <input class="focus:outline-none focus:ring-0" type="password" placeholder="Password"
                            id="password-register" name="password-register" required />
                        <x-input-error :messages="$errors->register->get('password-register')" />
                    </div>

                    {{-- <div class="input-field w-8/12 bg-LightGreen">
                        <i class="fas fa-lock"></i>
                        <input class="focus:outline-none focus:ring-0" type="password"
                            placeholder="Password Confirmation" id="password_register_confirmation"
                            name="password_register_confirmation" required />
                        <x-input-error :messages="$errors->register->get('password_register_confirmation')" />
                    </div> --}}


                    <button type="submit"
                        class="font-gotham bg-[#00615F] text-[#F9F3F0] py-2 rounded-full font-bold text-lg transition-all duration-300 ease-in-out text-center mt-4 hover:bg-[#F9F3F0] hover:text-[#00615F] cursor-pointer w-8/12 hover:outline hover:outline-[#00615F]">
                        {{ __('Sign Up') }}
                    </button>

                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content pl-4 pr-2 mt-8 md:pr-8 md:mt-0">
                    <h3 class="text-3xl mt-0 md:mt-10 font-gotham">Serve Smiles, One Meal at a Time—Join Us!</h3>
                    <p class="font-brandon text-lg">Sign up today and be part of something bigger.</p>
                    <div class="font-gotham w-6/12 bg-[#F9F3F0] text-[#00615F] py-2 rounded-full font-bold text-lg transition-all duration-300 ease-in-out text-center mt-4 hover:bg-[#00615F] hover:text-[#F9F3F0] cursor-pointer hover:outline hover:outline-[#F9F3F0]"
                        id="sign-up-btn">
                        Sign Up
                    </div>

                    <img src="{{ asset('assets/Image/5.png') }}" class="img-sign-in">
                </div>


            </div>
            <div class="panel right-panel">
                <div class="content text-center mb-5">
                    <h3 class="text-6xl mt-0 md:mt-15 font-gotham">Registered?</h3>
                    <p class="font-brandon">
                        Perfect! Let’s make kindness the new cool!
                    </p>
                    <div class="font-gotham w-7/12 bg-[#F9F3F0] text-[#00615F] py-2 rounded-full font-bold text-lg transition-all duration-300 ease-in-out text-center hover:bg-[#00615F] hover:text-[#F9F3F0] cursor-pointer block mx-auto mt-4 hover:outline hover:outline-[#F9F3F0]"
                        id="sign-in-btn">
                        Sign In
                    </div>
                    <img src="{{ asset('assets/Image/6.png') }}" class="img-sign-up">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/signin.js') }}"></script>
</x-guest-layout>
