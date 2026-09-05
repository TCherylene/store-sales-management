@props(['title' => '', 'desc' => '', 'buttons' => [], 'filter' => false])
@php
    $colorMap = [
        'export' => 'success',
        'delete' => 'danger',
        'edit' => 'warning',
        'view' => 'info',
        'form' => 'danger',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-gray-200 bg-white']) }}>
    <!-- Card Header -->
    <div class="px-6 py-5 flex flex-col md:flex-row md:items-center justify-start space-x-3">
        <div class="flex-1">
            <h3 class="text-lg font-semibold text-gray-800">
                {{ $title }}
            </h3>
            @if ($desc)
                <p class="mt-1 text-sm text-gray-500">
                    {{ $desc }}
                </p>
            @endif
        </div>

        <div class="md:ml-auto flex items-center gap-2 flex-wrap md:justify-end">
            @if ($filter)
                <x-button color="white" icon="filter">
                    Filter
                </x-button>
            @endif

            @if (!empty($buttons))
                @foreach ($buttons as $key => $button)
                    @php
                        $color = $button['color'] ?? ($colorMap[$key] ?? 'primary');
                    @endphp
                    @if (isset($button['visible']) && !$button['visible'])
                        @continue
                    @endif
                    <x-button href="{{ $button['href'] }}" route="{{ $button['route'] }}"
                        color="{{ $button['color'] ?? 'primary' }}"
                        class="{{ !empty($button['class']) ? $button['class'] : '' }}" icon="{{ $button['icon'] ?? 'plus' }}">
                        {{ $button['label'] }}
                    </x-button>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Card Body -->
    <div class="px-4 py-2 border-t border-gray-100 sm:p-6">
        <div class="space-y-6">
            {{ $slot }}
        </div>
    </div>
</div>
