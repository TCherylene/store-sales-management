@php
    use App\Helpers\Helper;
@endphp
<x-app-layout layout="pdf">
    <h2>Data Penjualan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Toko</th>
                <th style="text-align: right">Nominal Transaksi (Rp)</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($sales as $index => $sale)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $sale->shop?->kode_toko_baru ?? $sale->kode_toko }}</td>
                    <td style="text-align: right">{{ Helper::format_number($sale->nominal_transaksi) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
