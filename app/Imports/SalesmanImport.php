<?php

namespace App\Imports;

use App\Models\Salesman;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class SalesmanImport implements ToCollection, WithHeadingRow
{
    public Collection $rows;

    public function collection(Collection $rows)
    {
        $this->rows = $rows->map(function ($row, $index) {
            $data = $row->toArray();
            $validator = Validator::make($data, [
                'kode_sales' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[A-Za-z].*$/', // Huruf diikuti angka
                ],

                'nama_sales' => [
                    'required',
                    'string',
                    'max:20',
                ],
            ]);

            $exists = !empty($data['kode_sales'])
                && Salesman::where(
                    'kode_sales',
                    $data['kode_sales']
                )->exists();

            $background = '';
            if($exists){
                $background = 'bg-warning';
            }
            if ($validator->errors()->count() >= 1) {
                $background = 'bg-danger';
            }

            return [
                'row' => $index + 2,
                'kode_sales' => $data['kode_sales'] ?? null,
                'nama_sales' => $data['nama_sales'] ?? null,
                'background' => $background,
                'errors' => $validator->errors()->all(),
                'exists' => $exists,
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
