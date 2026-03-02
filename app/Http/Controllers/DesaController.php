<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desa;

class DesaController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $desas = Desa::with('kecamatan.kabupaten.provinsi')
            ->when($q, function ($query) use ($q) {
                $query->where('nama', 'like', "%$q%");
            })
            ->get();

        return view('public.index', compact('desas', 'q'));
    }

    public function show(Desa $desa)
    {
        return view('public.desa', compact('desa'));
    }

}

