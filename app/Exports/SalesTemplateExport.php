<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
class SalesTemplateExport implements FromArray
{
    public function array(): array
    {
        return [
            [
                'Kode Toko',
                'Nominal Transaksi',
            ],
        ];
    }
}

