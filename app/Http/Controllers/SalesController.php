<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Requests\Transactions\SalesRequest;

class SalesController extends Controller
{
    public string $folder_path = 'sales';

    public function index(Request $request)
    {
        $query = Sales::query()->with('shop');

        if ($request->kode_toko !== null && $request->kode_toko !== '') {
            $query->where(
                'kode_toko',
                'like',
                '%' . $request->kode_toko . '%'
            );
        }

        $sales = $query
            ->orderBy('kode_toko')
            ->paginate($this->perPage)
            ->withQueryString();

        return view(
            $this->buildPage('index'),
            compact('sales')
        );
    }

    public function create()
    {
        $shops = Shop::listAll();
        if (empty($shops)) {
            return redirect()
                ->route('sales.index')
                ->with('error', 'Tidak ada data toko tersedia, silahkan buat toko terlebih dahulu.');
        }
        return view(
            $this->buildPage('create'),
            compact('shops')
        );
    }

    public function store(SalesRequest $request)
    {
        Sales::create($request->payload());

        return redirect()
            ->route('sales.index')
            ->with('success', 'Berhasil membuat transaksi penjualan.');
    }

    public function edit(Sales $sale)
    {
        $shops = Shop::listAll();
        if (empty($shops)) {
            return redirect()
                ->route('sales.index')
                ->with('error', 'Tidak ada data toko tersedia, silahkan buat toko terlebih dahulu.');
        }
        return view(
            $this->buildPage('edit'),
            compact('sale', 'shops')
        );
    }

    public function update(SalesRequest $request, Sales $sale)
    {
        $sale->update($request->payload());

        return redirect()
            ->route('sales.index')
            ->with('success', 'Berhasil mengubah transaksi penjualan.');
    }

    public function show(Sales $sale)
    {
        $sale->load('shop');

        return view(
            $this->buildPage('show'),
            compact('sale')
        );
    }

    public function destroy(Sales $sale)
    {
        $sale->delete();

        return redirect()
            ->route('sales.index')
            ->with('success', 'Berhasil menghapus transaksi penjualan.');
    }
}
