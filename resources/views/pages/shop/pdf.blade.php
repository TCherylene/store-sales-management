<x-app-layout layout="pdf">
    <h2>Data Toko</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Toko Baru</th>
                <th>Kode Toko Lama</th>
                <th>Area Sales</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($shops as $index => $shop)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $shop->kode_toko_baru }}</td>
                    <td>{{ $shop->kode_toko_lama }}</td>
                    <td>{{ $shop->getAreaName() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
