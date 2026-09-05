<?php

namespace App\Exports;

use App\Models\Salesman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesmanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Salesman::query()
            ->orderBy('kode_sales')
            ->get([
                'kode_sales',
                'nama_sales',
            ]);
    }

    public function headings(): array
    {
        return [
            'Kode Sales',
            'Nama Sales',
        ];
    }
}
