<?php

namespace App\Imports;

use App\Models\Salesman;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SalesmanImport implements ToCollection, WithHeadingRow
{
    public Collection $rows;

    public function collection(Collection $rows)
    {
        $this->rows = $rows;
    }

    public function save()
    {
        foreach ($this->rows as $row) {
            Salesman::updateOrCreate(
                [
                    'kode_sales' => strtoupper($row['kode_sales']),
                ],
                [
                    'nama_sales' => $row['nama_sales'],
                ]
            );
        }
    }
}
