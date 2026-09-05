<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class SalesmanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_sales' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z].*$/', // Huruf diikuti angka
                'unique:table_d,kode_sales,' . ($this->route('salesman')?->kode_sales ?? 'NULL') . ',kode_sales',
            ],

            'nama_sales' => [
                'required',
                'string',
                'max:20',
            ],
        ];
    }

    public function payload(): array
    {
        return [
            'kode_sales' => strtoupper($this->kode_sales),
            'nama_sales' => $this->nama_sales,
        ];
    }

    public function messages(): array
    {
        return [
            'kode_sales.regex' => 'Kode salesman harus diawali dengan huruf.',
            'kode_sales.unique' => 'Kode salesman sudah digunakan.',
            'nama_sales.max' => 'Nama salesman maksimal 20 karakter.',
        ];
    }
}
