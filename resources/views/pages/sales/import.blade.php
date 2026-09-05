@php
    use App\Helpers\Helper;
@endphp
<x-app-layout title="Import Sales">
    <x-card title="Import Sales">
        <form action="{{ route('sales.import.preview') }}" method="POST" enctype="multipart/form-data">
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
                <a href="{{ route('sales.import.template') }}">
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
                            <th class="text-left">Kode Toko</th>
                            <th class="text-right">Nominal Transaksi (Rp)</th>
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
                                    {{ $row['kode_toko'] ?? '-' }}
                                </td>

                                <td class="text-right">
                                    {{ Helper::format_number($row['nominal_transaksi']) ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Tidak ada data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($rows->isNotEmpty())
                <div class="mt-4">
                    <x-form action="{{ route('sales.import.store') }}" method="POST">
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
