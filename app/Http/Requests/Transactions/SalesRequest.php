<?php

namespace App\Http\Requests\Transactions;

use App\Models\Shop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SalesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $kodeToko = $this->route('sale')?->kode_toko;

        return [
            'kode_toko' => [
                'required',
                'integer',
                'exists:table_a,kode_toko_baru',
                Rule::unique('table_b', 'kode_toko')
                    ->ignore($kodeToko, 'kode_toko'),
            ],

            'nominal_transaksi' => [
                'required',
                'numeric',
                'min:0',
                'max:8',
                'decimal:8,2',
            ],
        ];
    }

    public function payload(): array
    {
        return [
            'kode_toko' => $this->kode_toko,
            'nominal_transaksi' => $this->nominal_transaksi,
        ];
    }

    public function messages(): array
    {
        return [
            'kode_toko.required' => 'Toko wajib dipilih.',
            'kode_toko.integer' => 'Kode toko tidak valid.',
            'kode_toko.exists' => 'Toko yang dipilih tidak ditemukan.',
            'kode_toko.unique' => 'Toko tersebut sudah memiliki transaksi.',

            'nominal_transaksi.required' => 'Nominal transaksi wajib diisi.',
            'nominal_transaksi.numeric' => 'Nominal transaksi harus berupa angka.',
            'nominal_transaksi.min' => 'Nominal transaksi tidak boleh kurang dari 0.',
            'nominal_transaksi.decimal' => 'Nominal transaksi maksimal memiliki 2 angka desimal.',
        ];
    }
}
