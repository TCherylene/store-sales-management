<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class SalesmanTemplateExport implements FromArray
{
    public function array(): array
    {
        return [
            [
                'kode_sales',
                'nama_sales',
            ],
        ];
    }
}
