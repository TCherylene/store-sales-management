<?php

namespace App\Exports;

use App\Models\Sales;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Sales::query()
            ->orderBy('kode_toko')
            ->get([
                'kode_toko',
                'nominal_transaksi',
            ]);
    }

    public function headings(): array
    {
        return [
            'Kode Toko',
            'Nominal Transaksi',
        ];
    }
}
