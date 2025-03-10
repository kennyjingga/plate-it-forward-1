{{-- <button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'font-gotham inline-flex items-center px-4 py-2 bg-[#00615F] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#00524F] focus:bg-[#00524F] active:bg-[#00443F] focus:outline-none focus:ring-2 focus:ring-[#00615F] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}

<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'font-gotham inline-flex justify-center items-center px-4 py-2 bg-[#00615F] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#00524F] focus:bg-[#00524F] active:bg-[#00443F] focus:outline-none focus:ring-2 focus:ring-[#00615F] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
