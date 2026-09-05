<?php
$breadcrumbs = [
    ['label' => "Daftar Salesman", 'url' => route('salesman.index')],
    ['label' => $salesman->nama_sales],
];

$buttons = [
    'edit' => [
        'label' => "Update",
        'href' => route('salesman.edit', $salesman),
        'route' => 'salesman.edit',
        'icon' => 'pen',
        'color' => 'warning',
    ],
];

$title = "Detail Salesman " . $salesman->nama_sales;
?>

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
    <x-card title="{{ $title }}" :buttons="$buttons">
        <div class="table-responsive">
            <table class="w-full text-sm mb-6 border-collapse">
                <tbody>
                    <tr>
                        <td class="w-1/4 text-gray-500 py-2">
                            Kode Salesman
                        </td>
                        <td class="font-semibold py-2">
                            {{ $salesman->kode_sales }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 py-2">
                            Nama Salesman
                        </td>
                        <td class="font-semibold py-2">
                            {{ $salesman->nama_sales }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-card>
</x-app-layout>
