@php
    $breadcrumbs = [
        ['label' => "Daftar User", 'url' => route('user.index')],
        ['label' => "Tambah User",]
    ];

    $title = "Buat User"
@endphp

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
    <x-card title="{{ $title }}">
        <x-form action="{{ route('user.store') }}" method="POST">
            @include('pages.user._form')
        </x-form>
    </x-card>
</x-app-layout>
