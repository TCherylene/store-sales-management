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
            @if (!empty($buttons))
                @foreach ($buttons as $key => $button)
                    @php
                        $color = $button['color'] ?? ($colorMap[$key] ?? 'primary');
                    @endphp
                    @if (isset($button['visible']) && !$button['visible'])
                        @continue
                    @endif
                    @if (($button['type'] ?? 'link') === 'dropdown')
                        <div class="relative inline-block js-dropdown">
                            <x-button type="button" color="{{ $color }}" icon="{{ $button['icon'] ?? 'print' }}"
                                class="{{ $button['class'] ?? '' }} js-dropdown-toggle">
                                {{ $button['label'] }}
                            </x-button>

                            <div
                                class="js-dropdown-menu absolute right-0 top-full z-40 mt-1 hidden min-w-max rounded-lg border border-gray-200 bg-white p-2 shadow-lg">
                                @foreach ($button['items'] ?? [] as $item)
                                    <a @if (!empty($item['print'])) onclick="openPrint('{{ $item['href'] }}')" @else
                                    href="{!! $item['href'] !!}" @endif
                                        class="flex w-full cursor-pointer select-none items-center gap-2 whitespace-nowrap rounded-md px-3 py-2 text-md text-gray-700 hover:bg-gray-100">
                                        @if (!empty($item['icon']))
                                            <i class="fas fa-{{ $item['icon'] }}"></i>
                                        @endif

                                        <span>{{ $item['label'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <x-button href="{{ $button['href'] }}" route="{{ $button['route'] }}"
                            color="{{ $button['color'] ?? 'primary' }}"
                            class="{{ !empty($button['class']) ? $button['class'] : '' }}" icon="{{ $button['icon'] ?? 'plus' }}">
                            {{ $button['label'] }}
                        </x-button>
                    @endif
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

@push('scripts')
    <script>
        $('.js-dropdown-toggle').on('click', function (e) {
            e.stopPropagation();

            const $dropdown = $(this).closest('.js-dropdown');
            const $menu = $dropdown.find('.js-dropdown-menu');

            $('.js-dropdown-menu').not($menu).hide();

            $menu.toggle();
        });

        $(document).on('click', function () {
            $('.js-dropdown-menu').hide();
        });

        $('.js-dropdown-menu').on('click', function (e) {
            e.stopPropagation();
        });
    </script>
@endpush
