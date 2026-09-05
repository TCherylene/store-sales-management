<x-app-layout layout="pdf">
    <h2>Data Salesman</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Sales</th>
                <th>Nama Sales</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($salesmen as $index => $salesman)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $salesman->kode_sales }}</td>
                    <td>{{ $salesman->nama_sales }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
