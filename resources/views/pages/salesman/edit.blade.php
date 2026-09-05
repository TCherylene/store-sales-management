@php
    $breadcrumbs = [
        ['label' => "Daftar Salesman", 'url' => route('salesman.index')],
        ['label' => $salesman->nama_sales, 'url' => route('salesman.show', $salesman)],
        ['label' => "Update"],
    ];

    $title = "Update Salesman " . $salesman->nama_sales;
@endphp

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
    <x-card title="{{ $title }}">
        <x-form action="{{ route('salesman.update', $salesman) }}" method="PUT">
            @include('pages.salesman._form', $salesman)
        </x-form>
    </x-card>
</x-app-layout>
