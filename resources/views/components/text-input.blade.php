@props(['disabled' => false])

{{-- <input @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}> --}}
<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'font-brandon border-DefaultGreen focus:border-DefaultGreen focus:ring-DefaultGreen rounded-md shadow-sm']) }}>
