<?php

namespace App\Http\Controllers;

use App\Models\Salesman;

use Illuminate\Http\Request;

use App\Http\Requests\Master\SalesmanRequest;
use Illuminate\Support\Facades\DB;

class SalesmanController extends Controller
{
    public string $folder_path = 'salesman';

    public function index(Request $request)
    {
        $query = Salesman::query();

        if ($request->kode_sales !== null && $request->kode_sales !== '') {
            $query->where('kode_sales', 'like', '%' . $request->kode_sales . '%');
        }

        if ($request->nama_sales !== null && $request->nama_sales !== '') {
            $query->where('nama_sales', 'like', '%' . $request->nama_sales . '%');
        }

        $salesmen = $query
            ->orderBy('kode_sales')
            ->paginate($this->perPage)
            ->withQueryString();

        return view($this->buildPage('index'), compact('salesmen'));
    }

    public function create()
    {
        return view($this->buildPage('create'));
    }

    public function store(SalesmanRequest $request)
    {
        Salesman::create($request->payload());

        return redirect()
            ->route('salesman.index')
            ->with('success', "Berhasil membuat salesman baru.");
    }

    public function edit(Salesman $salesman)
    {
        return view($this->buildPage('edit'), compact('salesman'));
    }

    public function update(SalesmanRequest $request, Salesman $salesman)
    {
        $salesman->update($request->payload());

        return redirect()
            ->route('salesman.index')
            ->with('success', "Berhasil mengubah data salesman.");
    }

    public function show(Salesman $salesman)
    {
        return view($this->buildPage('show'), compact('salesman'));
    }

    public function destroy(Salesman $salesman)
    {
        $areaSales = $salesman->areaname;

        // Cek apakah masih ada toko yang menggunakan area salesman ini
        $isAreaUsed = DB::table('table_c')
            ->where('area_sales', $areaSales)
            ->exists();

        if ($isAreaUsed) {
            // Check if there is any salesman in sme area
            $hasOtherSalesman = Salesman::query()
                ->where('kode_sales', 'like', $areaSales . '%')
                ->where('kode_sales', '!=', $salesman->kode_sales)
                ->exists();

            if (!$hasOtherSalesman) {
                return redirect()
                    ->route('salesman.index')
                    ->with(
                        'error',
                        "Salesman {$salesman->nama_sales} tidak dapat dihapus karena merupakan satu-satunya salesman di area {$areaSales} yang masih digunakan oleh toko."
                    );
            }
        }

        $salesman->delete();
        return redirect()
            ->route('salesman.index')
            ->with('success', "Berhasil menghapus salesman.");
    }
}
