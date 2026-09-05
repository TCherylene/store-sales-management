<x-field
    label="Kode Toko Baru"
    name="kode_toko_baru"
    value="{{ old('kode_toko_baru', $shop->kode_toko_baru ?? '') }}"
    :readonly="isset($shop)"
    class="w-full lg:w-1/4"
    required="true">
</x-field>

<x-field
    label="Kode Toko Lama"
    name="kode_toko_lama"
    value="{{ old('kode_toko_lama', $shop->kode_toko_lama ?? '') }}"
    class="w-full lg:w-1/4">
</x-field>

<x-field
    type="dropdown"
    :items="$areas"
    prompt="-- Pilih Area --"
    label="Area Sales"
    name="area_sales"
    value="{{  old('area_sales') }}"
    class="w-full lg:w-1/4"
    required="true"
></x-field>

<x-submit-button>
</x-submit-button>
