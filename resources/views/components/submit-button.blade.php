@props([
    'color' => 'primary',
    'icon' => null,
    'title' => null,
    'class' => null,
])

@php
    $slotContent = trim((string) $slot);
@endphp

<x-button type="submit" color="{{ $color }}" icon="{{ $icon }}" class="{{ $class }}">
    @if(empty($slotContent))
        Simpan
    @else
        {{ $slot }}
    @endif
</x-button>
