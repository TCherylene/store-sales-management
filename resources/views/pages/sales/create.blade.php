@php
    $breadcrumbs = [
        ['label' => "Daftar Penjualan", 'url' => route('sales.index')],
        ['label' => "Tambah Penjualan"],
    ];

    $title = "Buat Penjualan";
@endphp

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
    <x-card title="{{ $title }}">
        <x-form action="{{ route('sales.store') }}" method="POST">
            @include('pages.sales._form')
        </x-form>
    </x-card>
</x-app-layout>
