<?php
use App\Helpers\Helper;
$breadcrumbs = [['label' => "Daftar Penjualan"]];
$buttons = [
    'import' => [
        'label' => "Import",
        'href' => route('sales.import'),
        'route' => 'sales.import',
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
                'href' => route('sales.export.pdf', $sales),
                'route' => 'sales.export.pdf',
                'icon' => 'file-pdf',
            ],
            [
                'label' => "Export Excel",
                'href' => route('sales.export.excel', $sales),
                'route' => 'sales.export.excel',
                'icon' => 'file-excel',
            ],
        ]
    ],
    'create' => [
        'label' => "Buat Penjualan",
        'href' => route('sales.create'),
        'route' => 'sales.create',
        'icon' => 'plus',
    ],
];
?>


<x-app-layout title="Daftar Penjualan" :breadcrumbs="$breadcrumbs">
    <x-card title="Daftar Penjualan" :buttons="$buttons">
        <x-slot name="filter">
            <x-field label="Toko" name="kode_toko" value="{{ request('kode_toko') }}" class="w-full lg:w-1/4">
            </x-field>
        </x-slot>


        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-left">Toko</th>
                        <th class="text-right">Nominal Transaksi (Rp)</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($sales as $index => $sale)
                        <tr>
                            <td class="text-center">
                                {{  $sales->firstItem() + $index }}
                            </td>
                            <td>
                                {{ $sale->shop?->kode_toko_baru ?? $sale->kode_toko }}
                            </td>
                            <td class="text-right">
                                {{ Helper::format_number($sale->nominal_transaksi) }}
                            </td>
                            <td class="text-center flex justify-center items-center gap-1">
                                <x-button href="{{ route('sales.show', $sale) }}" route="sales.show" icon="search" />
                                <x-delete-index route="{{ route('sales.destroy', $sale) }}"></x-delete-index>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Tidak ada data penjualan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            @include('components.paging', [
                'data' => $sales
            ])
        </div>

    </x-card>
</x-app-layout>
