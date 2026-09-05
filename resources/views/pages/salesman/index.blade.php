<?php

$breadcrumbs = [['label' => "Daftar Salesman"]];

$buttons = [
    'create' => [
        'label' => "Buat Salesman",
        'href' => route('salesman.create'),
        'route' => 'salesman.create',
        'icon' => 'plus',
    ],
];

?>

<x-app-layout title="Daftar Salesman" :breadcrumbs="$breadcrumbs">
    <x-card title="Daftar Salesman" :buttons="$buttons">
        <x-slot name="filter" :action="route('salesman.index')">
            <x-field label="Kode Salesman" name="kode_sales" value="{{ request('kode_sales') }}"
                class="w-full lg:w-1/4">
            </x-field>
            <x-field label="Nama Salesman" name="nama_sales" value="{{ request('nama_sales') }}"
                class="w-full lg:w-1/4">
            </x-field>
        </x-slot>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th class="text-left">Kode Salesman</th>
                        <th class="text-left">Nama Salesman</th>
                        <th class="text-center" width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($salesmen as $index => $salesman)
                        <tr>
                            <td class="text-center">
                                {{ $salesmen->firstItem() + $index }}
                            </td>
                            <td>
                                {{ $salesman->kode_sales }}
                            </td>
                            <td>
                                {{ $salesman->nama_sales }}
                            </td>
                            <td class="text-center">
                                <div class="flex gap-1">
                                    <x-button href="{{ route('salesman.show', $salesman) }}" route="salesman.show"
                                        icon="search" />
                                    <x-delete-index route="{{ route('salesman.destroy', $salesman) }}"></x-delete-index>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-center text-gray-500">
                                Tidak ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @include('components.paging', [
            'model' => $salesmen,
        ])

    </x-card>
</x-app-layout>
