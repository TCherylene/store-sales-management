<?php

namespace App\Http\Requests\Master;

use App\Models\Salesman;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $kode = $this->route('shop')?->kode_toko_baru;

        return [
            'kode_toko_baru' => [
                'required',
                'integer',
                'min:1',
                'unique:table_a,kode_toko_baru,' . ($kode ?? 'NULL') . ',kode_toko_baru',
            ],

            'kode_toko_lama' => [
                'nullable',
                'integer',
                'min:1',
                'different:kode_toko_baru',
            ],

            'area_sales' => [
                'required',
                'string',
                'max:10',
                Rule::in(Salesman::listArea()),
            ],
        ];
    }

    public function payload(): array
    {
        return [
            'kode_toko_baru' => $this->kode_toko_baru,
            'kode_toko_lama' => $this->kode_toko_lama,
        ];
    }

    public function messages(): array
    {
        return [
            'kode_toko_baru.required' => 'Kode toko baru wajib diisi.',
            'kode_toko_baru.integer' => 'Kode toko baru harus berupa angka.',
            'kode_toko_baru.unique' => 'Kode toko baru sudah digunakan.',

            'kode_toko_lama.integer' => 'Kode toko lama harus berupa angka.',
            'kode_toko_lama.different' => 'Kode toko lama tidak boleh sama dengan kode toko baru.',

            'area_sales.required' => 'Area wajib dipilih.',
            'area_sales.max' => 'Area maksimal 10 karakter.',
            'area_sales.in' => 'Area yang dipilih tidak valid.',
        ];
    }
}
