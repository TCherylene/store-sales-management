@props([
    'color' => 'primary',
    'href' => null,
    'icon' => null,
    'iconVariant' => 'solid',
    'type' => 'button',
    'route' => '',
    'visible' => true,
    'print' => false,
])

@php
    $colors = [
        'primary' => 'var(--color-primary)',
        'secondary' => 'var(--color-secondary)',
        'success' => 'var(--color-success)',
        'danger' => 'var(--color-danger)',
        'info' => 'var(--color-info)',
        'warning' => 'var(--color-warning)',
        'white' => 'var(--color-gray-50)',
    ];

    $textColors = [
        'primary' => '#fff',
        'secondary' => '#000',
        'success' => '#fff',
        'danger' => '#fff',
        'info' => '#fff',
        'warning' => '#fff',
        'white' => '#000',
    ];

    $text = $textColors[$color] ?? '#fff';

    $padding_size = !empty(trim($icon)) && empty(trim($slot)) ? 'px-2' : 'px-4';
    $baseClasses = "inline-flex items-center gap-2 rounded-lg py-3 $padding_size text-sm items-center justify-center
                hover:opacity-90 shadow-theme-xs hover:cursor-pointer focus:outline-none focus:ring-2 ";
    $bg = $colors[$color] ?? $colors['primary'];

    if ($color == 'white') {
        $baseClasses .= ' border border-1 border-gray-300 hover:border-gray-400 focus:border-gray-400';
    }

    $classes = $baseClasses . ' ' . ($attributes->get('class') ?? '');
    $style = "background-color: $bg; color: $text;";
@endphp
@if ($visible)
    @if($href)
        <a href="{!! $href !!}" {{ $attributes->except(['class'])->merge(['class' => $classes, 'style' => $style]) }}>
            @if (!empty($icon))
                <i class="fas fa-{{ $icon }}"></i>
            @endif

            {{ $slot }}
        </a>
    @else
        <button type="{{ $type }}" {{ $attributes->except(['class'])->merge(['class' => $classes, 'style' => $style]) }}>
            @if (!empty($icon))
                <i class="fas fa-{{ $icon }}"></i>
            @endif

            {{ $slot }}
        </button>
    @endif
@endif
