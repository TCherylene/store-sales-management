@php
    $breadcrumbs = [
        ['label' => "Daftar Toko", 'url' => route('shop.index')],
        ['label' => "Tambah Toko"],
    ];

    $title = "Buat Toko";
@endphp

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
    <x-card title="{{ $title }}">
        <x-form action="{{ route('shop.store') }}" method="POST">
            @include('pages.shop._form')
        </x-form>
    </x-card>
</x-app-layout>
