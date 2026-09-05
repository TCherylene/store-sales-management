@props([
    'value' => null,
    'labels' => [],
    'active' => null,
    'pending' => null,
    'cancelled' => [],
])

@php
    $cancelledList = is_array($cancelled) ? $cancelled : [$cancelled];

    if (in_array($value, $cancelledList)) {
        $classes = 'bg-red-100 text-red-700';
    } elseif ($pending !== null && $value === $pending) {
        $classes = 'bg-yellow-100 text-yellow-700';
    } else {
        $classes = 'bg-green-100 text-green-700';
    }
@endphp

<span class="px-2 py-1 rounded-full text-xs font-semibold {{ $classes }}">
    {{ $labels[$value] ?? '-' }}
</span>
