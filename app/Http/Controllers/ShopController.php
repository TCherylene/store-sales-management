<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Salesman;
use Illuminate\Http\Request;
use App\Http\Requests\Master\ShopRequest;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public string $folder_path = 'shop';

    public function index(Request $request)
    {
        $query = Shop::query();

        if ($request->kode_toko_baru !== null && $request->kode_toko_baru !== '') {
            $query->where(
                'kode_toko_baru',
                'like',
                '%' . $request->kode_toko_baru . '%'
            );
        }

        if ($request->kode_toko_lama !== null && $request->kode_toko_lama !== '') {
            $query->where(
                'kode_toko_lama',
                'like',
                '%' . $request->kode_toko_lama . '%'
            );
        }

        $shops = $query
            ->orderBy('kode_toko_baru')
            ->paginate($this->perPage)
            ->withQueryString();

        return view(
            $this->buildPage('index'),
            compact('shops')
        );
    }

    public function create()
    {
        $areas = Salesman::listArea();
        if (empty($areas)) {
            return redirect()
                ->route('shop.index')
                ->with("error", "Area Sales tidak tersedia. Silahkan buat salesman terlebih dahulu");
        }

        return view(
            $this->buildPage('create'),
            compact('areas')
        );
    }

    public function store(ShopRequest $request)
    {
        DB::transaction(function () use ($request) {
            $shop = Shop::create([
                'kode_toko_baru' => $request->kode_toko_baru,
                'kode_toko_lama' => $request->kode_toko_lama,
            ]);

            DB::table('table_c')->insert([
                'kode_toko' => $shop->kode_toko_baru,
                'area_sales' => $request->area_sales,
            ]);
        });

        return redirect()
            ->route('shop.index')
            ->with('success', 'Berhasil membuat toko baru.');
    }

    public function edit(Shop $shop)
    {
        $areas = Salesman::listArea();
        if (empty($areas)) {
            return redirect()
                ->route('shop.index')
                ->with("error", "Area Sales tidak tersedia. Silahkan buat salesman terlebih dahulu");
        }

        return view(
            $this->buildPage('edit'),
            compact('shop', 'areas')
        );
    }

    public function update(ShopRequest $request, Shop $shop)
    {
        DB::transaction(function () use ($request, $shop) {
            $shop->update([
                'kode_toko_lama' => $request->kode_toko_lama,
            ]);

            DB::table('table_c')
                ->updateOrInsert(
                    [
                        'kode_toko' => $shop->kode_toko_baru,
                    ],
                    [
                        'area_sales' => $request->area_sales,
                    ]
                );
        });

        return redirect()
            ->route('shop.index')
            ->with('success', 'Berhasil mengubah data toko.');
    }

    public function show(Shop $shop)
    {
        return view(
            $this->buildPage('show'),
            compact('shop')
        );
    }

    public function destroy(Shop $shop)
    {
        // Check if this shop has any transactions
    }
}
