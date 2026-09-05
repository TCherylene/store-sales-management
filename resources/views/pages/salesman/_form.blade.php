<x-field
    label="Kode Salesman"
    name="kode_sales"
    value="{{ old('kode_sales', $salesman->kode_sales ?? '') }}"
    :readonly="isset($salesman)"
    class="w-full lg:w-1/4"
    required="true">
</x-field>

<x-field
    label="Nama Salesman"
    name="nama_sales"
    value="{{ old('nama_sales', $salesman->nama_sales ?? '') }}"
    class="w-full lg:w-1/3"
    required="true">
</x-field>

<x-submit-button>
</x-submit-button>
