@props(['items', 'title' => $title])

<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <h2 class="text-xl font-bold text-gray-800">
        {{ $title }}
    </h2>
    <nav>
        <ol class="flex items-center gap-1.5">
            <li>
                <a class="inline-flex items-center gap-1.5 text-sm text-gray-500" href="{{ url('/') }}">
                    Home
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
            @foreach ($items as $i => $item)
                @php
                    $text = $item['label'];
                    if (!empty($items[$i + 1])) {
                        $text .= '<i class="fas fa-chevron-right"></i>';
                    }
                @endphp
                <li class="text-sm text-gray-800">
                    @if (!empty($item['url']))
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500" href="{{ $item['url'] }}">
                            {!! $text !!}
                        </a>
                    @else
                        <span class="font-medium text-brand-rimary">
                            {!! $text !!}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
</div>
