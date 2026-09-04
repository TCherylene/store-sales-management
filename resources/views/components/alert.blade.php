@php
    $color_map = [
        'primary' => 'bg-primary text-white',
        'success' => 'bg-success-100 text-success-700',
        'danger' => 'bg-red-100 text-red-700',
        'warning' => 'bg-yellow-100 text-yellow-700',
        'info' => 'bg-cyan-200 text-cyan-700',
    ];

    if (isset($color) && !in_array($color, array_keys($color_map))) {
        $color = 'primary';
    }

    $color_text = $color_map[$color ?? 'primary'];
@endphp

<div class="lg:w-1/2 alert">
    <div class="{{ $color_map[$color ?? 'primary'] }} p-3 rounded-md mb-3">
        <div class="flex flex-row justify-between align-center">
            <div>
                <strong>{{ $title }}</strong>
            </div>
            <button class="hover:cursor-pointer" id="close_alert">
                <i class="fas fa-times"></i>
            </button>
        </div>
        {{ $slot }}
    </div>
</div>

@push('scripts')
    <script>
        $("#close_alert").on("click", function () {
            $(this).closest(".alert").remove();
        })
    </script>
@endpush
