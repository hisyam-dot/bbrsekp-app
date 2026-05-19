<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\DetailDesa;
use App\Models\SearchLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->q;

        $details = DetailDesa::with('desa.kecamatan.kabupaten.provinsi')
            ->when($search, function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%")
                    ->orWhereHas('desa', function($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%")
                            ->orWhereHas('kecamatan', function ($q2) use ($search) {
                                $q2->where('nama', 'like', "%{$search}%")
                                    ->orWhereHas('kabupaten', function ($q3) use ($search) {
                                        $q3->where('nama', 'like', "%{$search}%")
                                            ->orWhereHas('provinsi', function ($q4) use ($search) {
                                                $q4->where('nama', 'like', "%{$search}%");
                            });
                        });
                    });
                });
            })
            ->orderBy('judul')
            ->paginate(10)
            ->withQueryString();

        if ($search) {
            $keyword = Str::lower(trim($search));

            $log = SearchLog::where('keyword', $keyword)->first();

            if ($log) {
                $log->increment('total');
            } else {
                SearchLog::create([
                    'keyword' => $keyword,
                    'total' => 1,
                ]);
            }
        }

        $populer = SearchLog::orderByDesc('total')
            ->limit(5)
            ->get();

        $details->total();

        return view('public.index', compact('details', 'search', 'populer'));
    }

    public function show(DetailDesa $detail)
    {
        $detail->load('desa.kecamatan.kabupaten.provinsi');

        return view('public.desa', compact('detail'));
    }

    public function tentang()
    {
        return view('public.tentang');
    }
}