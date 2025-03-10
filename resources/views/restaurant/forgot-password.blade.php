<x-guest-layout>
    <img src="{{ asset('assets/Image/Logo copy.png') }}" class="w-64 h-64" alt="logo">
    <div class="mb-4 text-m text-gray-600 font-brandon">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-DefaultGreen" :status="session('status')" />

    <form method="POST" action="{{ route('restaurant.forgot') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" class="font-gotham" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 mb-20">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
    <center>
        <a href="/restaurant/login"
            class="font-brandon underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none mb-18">
            {{ __('Back') }}
        </a>
    </center>
</x-guest-layout>
