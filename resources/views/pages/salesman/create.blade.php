@php
    $breadcrumbs = [
        ['label' => "Daftar Salesman", 'url' => route('salesman.index')],
        ['label' => "Tambah Salesman"],
    ];

    $title = "Buat Salesman";
@endphp

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
    <x-card title="{{ $title }}">
        <x-form action="{{ route('salesman.store') }}" method="POST">
            @include('pages.salesman._form')
        </x-form>
    </x-card>
</x-app-layout>
