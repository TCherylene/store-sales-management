<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'table_a';
    protected $primaryKey = 'kode_toko_baru';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'kode_toko_baru',
        'kode_toko_lama',
    ];

    public function areaSales()
    {
        return $this->hasOne(ShopArea::class, 'kode_toko', 'kode_toko_baru');
    }

    public function sales()
    {
        return $this->hasMany(Sales::class, 'kode_toko', 'kode_toko_baru');
    }

    public function getAreaName()
    {
        return $this->areaSales?->area_sales;
    }


    public static function listAll()
    {
        return Shop::query()
            ->pluck('kode_toko_baru')
            ->unique()
            ->sort()
            ->mapWithKeys(fn($toko) => [$toko => $toko])
            ->toArray();
    }
}
