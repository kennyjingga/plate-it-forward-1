<x-app-layout>

    <x-navbarAfterLogin></x-navbarAfterLogin>

    <x-slot name="header">
        <div class="mt-8 bg-gradient-to-r from-green-800 to-blue-500 text-white p-6 rounded-lg shadow-lg">
            <h2 class="font-bold text-1xl sm:text-2xl lg:text-2xl leading-tight">
                {{ 'Hello, ' }} {{ auth()->user()->name }} {{ '!' }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
