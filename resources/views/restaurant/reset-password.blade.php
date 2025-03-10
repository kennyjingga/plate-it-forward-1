<x-guest-layout>


    <img src="{{ asset('assets/Image/Logo copy.png') }}" class="w-40 h-40" alt="logo">
    {{-- <form method="POST" action={{ route('restaurant.reset-submit') }}>

        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label>Password Baru:</label>
        <input type="password" name="password" required>
        <label>Konfirmasi Password:</label>
        <input type="password" name="password_confirmation" required>
        <button type="submit">Reset Password</button>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-100 cursor-not-allowed" type="email"
                name="email" :value="old('email', $request->email)" required autofocus autocomplete="off" readonly />

        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <center>
            <div class="mt-4">
                <x-primary-button class="mb-20">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </center>
    </form> --}}
    <form method="POST" action="{{ route('restaurant.reset-submit') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <center>
            <div class="mt-4">
                <x-primary-button class="mb-20">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </center>
    </form>

</x-guest-layout>
