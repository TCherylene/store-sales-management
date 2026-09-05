<?php

namespace App\Imports;

use App\Models\Shop;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;


class ShopImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public Collection $rows;
    public function collection(Collection $rows)
    {
        $this->rows = $rows->map(function ($row, $index) {
            $data = $row->toArray();

            $validator = Validator::make($data, [
                'kode_toko_baru' => [
                    'required',
                    'integer',
                    'min:1',
                ],
                'kode_toko_lama' => [
                    'nullable',
                    'integer',
                    'min:1',
                    'different:kode_toko_baru',
                ],
                'area_toko' => [
                    'required',
                    'string',
                    'max:10',
                ],
            ]);

            $exists = !empty($data['kode_toko_baru'])
                && Shop::where(
                    'kode_toko_baru',
                    $data['kode_toko_baru']
                )->exists();

            $background = '';
            if ($exists) {
                $background = 'bg-warning';
            }
            if ($validator->errors()->count() >= 1) {
                $background = 'bg-danger';
            }

            return [
                'row' => $index + 2,
                'kode_toko_baru' => $data['kode_toko_baru'] ?? null,
                'kode_toko_lama' => $data['kode_toko_lama'] ?? null,
                'area_sales' => strtoupper($data['area_toko']) ?? null,
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
            $kode_toko_baru = $row['kode_toko_baru'];
            $kode_toko_lama = $row['kode_toko_lama'];
            $area_sales = strtoupper($row['area_sales']);
            Shop::updateOrCreate(
                [
                    'kode_toko_baru' => $kode_toko_baru,
                ],
                [
                    'kode_toko_lama' => $kode_toko_lama,
                ]
            );

            DB::table('table_c')->updateOrInsert(
                [
                    'kode_toko' => $kode_toko_baru,
                ],
                [
                    'area_sales' => $area_sales,
                ]
            );
        }
    }
}
