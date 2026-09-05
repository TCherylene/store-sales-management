<?php

namespace App\Imports;

use App\Models\Shop;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ShopImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public Collection $rows;

    public function collection(Collection $rows)
    {
        $this->rows = $rows;
    }

    public function save()
    {
        foreach ($this->rows as $row) {
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
