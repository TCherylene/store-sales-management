<x-app-layout title="Import Toko">
    <x-card title="Import Toko">
        <form action="{{ route('shop.import.preview') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="file" class="block mb-1">
                    File Excel
                </label>

                <input type="file" name="file" id="file" accept=".xlsx,.xls" class="w-full border rounded px-3 py-2"
                    required>

                @error('file')
                    <div class="text-sm text-red-500 mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex gap-2">
                <x-submit-button>
                    Preview
                </x-submit-button>
                <a href="{{ route('shop.import.template') }}">
                    <x-button type="button" color="success" icon="download">
                        Download Template
                    </x-button>
                </a>

            </div>
        </form>
    </x-card>

    @isset($rows)
        <x-card title="Preview Data" class="mt-3" desc="{{ $rows->count() }} data ditemukan.">
            <div class="table-responsive">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-left">Kode Toko Baru</th>
                            <th class="text-left">Kode Toko Lama</th>
                            <th class="text-left">Area Sales</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($rows as $index => $row)
                            <tr>
                                <td class="text-center">
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    {{ $row['kode_toko_baru'] ?? '-' }}
                                </td>
                                <td>
                                    {{ $row['kode_toko_lama'] ?? '-' }}
                                </td>
                                <td>
                                    {{ $row['area_sales'] ?? '-' }}
                                </td>
                                <td class="{{ $row['background'] }}">
                                    @forelse($row['errors'] as $error)
                                        {{ $error }}
                                    @empty
                                        @if($row['exists'])
                                            Duplikat
                                        @else
                                            Valid
                                        @endif
                                    @endforelse
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Tidak ada data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($rows->isNotEmpty())
                <div class="mt-4">
                    <x-form action="{{ route('shop.import.store') }}" method="POST">
                        <input type="hidden" name="path" value="{{ $path }}">
                        <x-submit-button>
                            Import Data
                        </x-submit-button>
                    </x-form>
                </div>
            @endif
        </x-card>
    @endisset
</x-app-layout>
