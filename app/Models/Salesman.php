<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    protected $table = 'table_d';

    protected $primaryKey = 'kode_sales';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'kode_sales',
        'nama_sales',
    ];

    public function getAreaname(){
        $areaSales = preg_replace('/[0-9]+$/', '', $this->kode_sales); // remove any number
        return $areaSales;
    }

    public static function listArea()
    {
        return Salesman::query()
            ->get()
            ->map(fn ($salesman) => $salesman->getAreaname())
            ->unique()
            ->sort()
            ->mapWithKeys(fn ($area) => [$area => $area]) // add array key for dropdown
            ->all();
    }
}
