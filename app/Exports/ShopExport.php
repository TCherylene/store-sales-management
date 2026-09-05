<?php

namespace App\Exports;

use App\Models\Shop;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ShopExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $shops = Shop::query()
            ->with('areaSales')
            ->orderBy('kode_toko_baru')
            ->get()
            ->map(function ($shop) {
                return [
                    $shop->kode_toko_baru,
                    $shop->kode_toko_lama,
                    $shop->areaSales?->area_sales,
                ];
            })
            ->toArray();

        return $shops;
    }

    public function headings(): array
    {
        return [
            'Kode Toko Baru',
            'Kode Toko Lama',
            'Area Sales',
        ];
    }
}
