<?php

namespace App\Imports;

use App\Models\Sales;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;


class SalesImport implements ToCollection, WithHeadingRow
{
    public Collection $rows;

    public function collection(Collection $rows)
    {
        $this->rows = $rows;
    }

    public function save()
    {
        foreach ($this->rows as $row) {
            // TODO: add validation for existing kode toko only
            Sales::create([
                'kode_toko' => $row['kode_toko'],
                'nominal_transaksi' => $row['nominal_transaksi']
            ]);
        }
    }
}
