<x-guest-layout>
    <img src="{{ asset('assets/Image/Logo copy.png') }}" class="w-40 h-40" alt="logo">
    <div class="mb-4 text-m text-gray-600 font-brandon">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-[#00615F] font-brandon">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <center>
                <button type="submit"
                    class="font-brandon underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none mt-5">
                    {{ __('Back') }}
                </button>
            </center>
        </form>
    </div>
</x-guest-layout>
