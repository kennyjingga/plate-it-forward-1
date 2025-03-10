@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'font-brandon mt-1 text-sm text-red-600 space-y-1 w-64']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
