@php
    $breadcrumbs = [
        ['label' => "Daftar Penjualan", 'url' => route('shop.index')],
        ['label' => $sales->kode_toko, 'url' => route('shop.show', $sales)],
        ['label' => "Update"],
    ];

    $title = "Update Penjualan";
@endphp

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
    <x-card title="{{ $title }}">
        <x-form action="{{ route('shop.update', $sales) }}" method="POST">
            @include('pages.shop._form')
        </x-form>
    </x-card>
</x-app-layout>
