<?php
use App\Helpers\Helper;

$breadcrumbs = [
    ['label' => "Daftar Penjualan", 'url' => route('sales.index')],
    ['label' => $sale->id],
];
$buttons = [
    'edit' => [
        'label' => "Update",
        'href' => route('sales.edit', $sale),
        'route' => 'sales.edit',
        'icon' => 'pen',
        'color' => 'warning',
    ],
];

$title = "Detail Sales " . $sale->id;
?>

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
    <x-card title="{{ $title }}" :buttons="$buttons">
        <table class="w-full text-sm mb-6 border-collapse">
            <tbody>
                <tr>
                    <td class="w-1/4 text-gray-500 py-2">Toko</td>
                    <td class="font-semibold py-2">{{ $sale->shop?->kode_toko_baru ?? $sale->kode_toko }}</td>
                </tr>
                <tr>
                    <td class="text-gray-500 py-2">Nominal Transaksi (Rp)</td>
                    <td class="font-semibold py-2">{{  Helper::format_number($sale->nominal_transaksi) }}</td>
                </tr>
            </tbody>
        </table>

    </x-card>
</x-app-layout>
