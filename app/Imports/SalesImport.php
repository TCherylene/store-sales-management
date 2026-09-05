<?php

namespace App\Imports;

use App\Models\Sales;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;


class SalesImport implements ToCollection, WithHeadingRow
{
    public Collection $rows;

    public function collection(Collection $rows)
    {
        $this->rows = $rows;
        $this->rows = $rows->map(function ($row, $index) {
            $data = $row->toArray();

            $validator = Validator::make($data, [
                'kode_toko' => [
                    'required',
                    'integer',
                    'exists:table_a,kode_toko_baru',
                ],
                'nominal_transaksi' => [
                    'required',
                    'numeric',
                    'min:0',
                    'decimal:0,2',
                ],
            ]);


            $background = '';
            if ($validator->errors()->count() >= 1) {
                $background = 'bg-danger';
            }

            return [
                'row' => $index + 2,
                'kode_toko' => $data['kode_toko'] ?? null,
                'nominal_transaksi' => $data['nominal_transaksi'] ?? null,
                'background' => $background,
                'errors' => $validator->errors()->all(),
                'valid' => $validator->passes(),
            ];
        });
    }

    public function save()
    {
        foreach ($this->rows as $row) {
            if(!$row['valid']){
                continue;
            }
            Sales::create([
                'kode_toko' => $row['kode_toko'],
                'nominal_transaksi' => $row['nominal_transaksi']
            ]);
        }
    }
}
