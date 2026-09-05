<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class ShopTemplateExport implements FromArray
{
    public function array(): array
    {
        return [
            [
                'Kode Toko Baru',
                'Kode Toko Lama',
                'Area Toko'
            ]
        ];
    }
}
