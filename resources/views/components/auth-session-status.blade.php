@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-DefaultGreen']) }}>
        {{ $status }}
    </div>
@endif
