<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} | {{ env('APP_NAME', 'Store Management')}}</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    @include('layouts.partials.loader')
    <div class="min-h-screen xl:flex">
        @include('layouts.partials.backdrop')
        @include('layouts.partials.sidebar')

        {{-- Main Content --}}
        <div id="main-content" class="flex-1 transition-all duration-300 ease-in-out">

            @include('layouts.partials.header')

            {{-- Page Content --}}
            <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                {{ $slot }}
            </div>

        </div>

    </div>

    @stack('scripts')

</body>

</html>
