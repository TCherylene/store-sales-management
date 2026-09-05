<?php
$breadcrumbs = [
    ['label' => "Daftar Toko", 'url' => route('shop.index')],
    ['label' => $shop->kode_toko_baru],
];

$buttons = [
    'edit' => [
        'label' => "Update",
        'href' => route('shop.edit', $shop),
        'route' => 'shop.edit',
        'icon' => 'pen',
        'color' => 'warning',
    ],
];

$title = "Detail Toko " . $shop->kode_toko_baru;
?>

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
    <x-card title="{{ $title }}" :buttons="$buttons">
        <div class="table-responsive">
            <table class="w-full text-sm mb-6 border-collapse">
                <tbody>
                    <tr>
                        <td class="w-1/4 text-gray-500 py-2">
                            Kode Toko
                        </td>
                        <td class="font-semibold py-2">
                            {{ $shop->kode_toko_baru }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 py-2">
                            Kode Toko Lama
                        </td>
                        <td class="font-semibold py-2">
                            {{ $shop->kode_toko_lama ?? "-" }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 py-2">
                            Nama Area
                        </td>
                        <td class="font-semibold py-2">
                            {{ $shop->getAreaName() ?? "-" }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-card>
</x-app-layout>
