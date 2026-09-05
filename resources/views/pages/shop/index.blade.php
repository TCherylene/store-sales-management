<?php

$title = "Daftar Toko";
$breadcrumbs = [['label' => $title]];

$buttons = [
    'import' => [
        'label' => "Import",
        'href' => route('shop.import'),
        'route' => 'shop.import',
        'icon' => 'upload',
        'color' => 'info'
    ],
    'export_menu' => [
        'type' => 'dropdown',
        'label' => "Export",
        'icon' => 'download',
        'color' => 'success',
        'items' => [
            [
                'label' => "Export PDF",
                'href' => route('shop.export.pdf', $shops),
                'route' => 'shop.export.pdf',
                'icon' => 'file-pdf',
            ],
            [
                'label' => "Export Excel",
                'href' => route('shop.export.excel', $shops),
                'route' => 'shop.export.excel',
                'icon' => 'file-excel',
            ],
        ]
    ],
    'create' => [
        'label' => "Buat Toko",
        'href' => route('shop.create'),
        'route' => 'shop.create',
        'icon' => 'plus',
    ],
];
?>

<x-app-layout :title="$title" :breadcrumbs="$breadcrumbs">
    <x-card :title="$title" :buttons="$buttons">
        <x-slot name="filter">
            <x-field label="Kode Toko Baru" name="kode_toko_baru" value="{{ request('kode_toko_baru') }}"
                class="w-full lg:w-1/4">
            </x-field>

            <x-field label="Kode Toko Lama" name="kode_toko_lama" value="{{ request('kode_toko_lama') }}"
                class="w-full lg:w-1/4">
            </x-field>
        </x-slot>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th class="text-left">Kode Toko Baru</th>
                        <th class="text-left">Kode Toko Lama</th>
                        <th class="text-left" width="20%">Area</th>
                        <th class="text-center" width="10%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($shops as $index => $shop)
                        <tr>
                            <td class="text-center">
                                {{ $shops->firstItem() + $index }}
                            </td>
                            <td>
                                {{ $shop->kode_toko_baru }}
                            </td>
                            <td>
                                {{ $shop->kode_toko_lama ?? '-' }}
                            </td>
                            <td>
                                {{ $shop->getAreaName() ?? '-' }}
                            </td>
                            <td class="text-center flex justify-center items-center gap-1">
                                <x-button href="{{ route('shop.show', $shop) }}" route="shop.show" icon="search" />
                                <x-delete-index route="{{ route('shop.destroy', $shop) }}"></x-delete-index>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                Tidak ada data toko
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            @include('components.paging', [
                'model' => $shops
            ])
        </div>

    </x-card>
</x-app-layout>
