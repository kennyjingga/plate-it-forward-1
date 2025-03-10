@props(['value'])

<label {{ $attributes->merge(['class' => 'font-gotham block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
