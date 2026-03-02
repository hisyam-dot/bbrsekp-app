<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->q;

        $desas = Desa::with('kecamatan.kabupaten.provinsi')
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhereHas('kecamatan', function ($q) use ($search) {
                          $q->where('nama', 'like', "%{$search}%")
                            ->orWhereHas('kabupaten', function ($q2) use ($search) {
                                $q2->where('nama', 'like', "%{$search}%")
                                   ->orWhereHas('provinsi', function ($q3) use ($search) {
                                       $q3->where('nama', 'like', "%{$search}%");
                                   });
                            });
                      });
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('public.index', compact('desas', 'search'));
    }

    public function show(Desa $desa)
    {
        $desa->load('detailDesa');

        return view('public.desa', compact('desa'));
    }

    public function tentang()
    {
        return view('public.tentang');
    }
}