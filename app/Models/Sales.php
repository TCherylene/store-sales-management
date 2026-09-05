<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'table_b';
    
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'kode_toko',
        'nominal_transaksi',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'kode_toko', 'kode_toko_baru');
    }
}
