<x-field type="dropdown" :items="$shops" prompt="Pilih Toko" label="Kode Toko"
    name="kode_toko" class="w-full lg:w-1/4"
    required="true"
    value="{{  old('kode_toko', $sales->kode_toko ?? '') }}
">
</x-field>
<x-field label="Nominal Transaksi" name="nominal_transaksi" type="number" step="0.01" min="0"
    value="{{ old('nominal_transaksi', $sale->nominal_transaksi ?? '') }}" class="w-full lg:w-1/3" required="true">
</x-field>

<x-submit-button>
</x-submit-button>
