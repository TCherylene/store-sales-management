@php
    $breadcrumbs = [
        ['label' => "Daftar Toko", 'url' => route('shop.index')],
        ['label' => $shop->kode_toko, 'url' => route('shop.show', $shop)],
        ['label' => "Update"],
    ];

    $title = "Update toko";
@endphp

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
    <x-card title="{{ $title }}">
        <x-form action="{{ route('shop.update', $shop) }}" method="POST">
            @include('pages.shop._form')
        </x-form>
    </x-card>
</x-app-layout>
