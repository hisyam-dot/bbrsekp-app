<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\DetailDesa;
use App\Models\SearchLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PegawaiController extends Controller
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

        return view('pegawai.index', compact('details', 'search', 'populer'));
    }

    public function show(DetailDesa $detail)
    {
        $detail->load( 'desa.kecamatan.kabupaten.provinsi');
        
        return view('pegawai.desa', compact('detail'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'bahan_paparan.*' => 'nullable|file|mimes:pdf,doc,docx,xsl,xlsx|max:10240',
            'laporan.*' => 'nullable|file|mimes:pdf,doc,docx,xsl,xlsx|max:10240',
            'dokumen.*' => 'nullable|file|mimes:pdf,doc,docx,xsl,xlsx|max:10240',
        ]);

        $bahanPaparanPaths = [];
        $laporanPaths = [];
        $dokumenPaths = [];

        // Bahan Paparan
        if ($request->hasFile('bahan_paparan')) {

            foreach ($request->file('bahan_paparan') as $file) {

                $namaFile = now()->timestamp . '_' . $file->getClientOriginalName();

                $bahanPaparanPaths[] = $file->storeAs(
                    'bahan_paparans',
                    $namaFile,
                    'public'
                );

            }

        }

        // Laporan
        if ($request->hasFile('laporan')) {

            foreach ($request->file('laporan') as $file) {

                $namaFile = now()->timestamp . '_' . $file->getClientOriginalName();

                $laporanPaths[] = $file->storeAs(
                    'laporans',
                    $namaFile,
                    'public'
                );

            }

        }

        // Dokumen Lainnya
        if ($request->hasFile('dokumen')) {

            foreach ($request->file('dokumen') as $file) {

                $namaFile = now()->timestamp . '_' . $file->getClientOriginalName();

                $dokumenPaths[] = $file->storeAs(
                    'dokumens',
                    $namaFile,
                    'public'
                );

            }

        }

        DetailDesa::create([
            'provinsi_id' => $request->provinsi_id,
            'kabupaten_id' => $request->kabupaten_id,
            'kecamatan_id' => $request->kecamatan_id,
            'desa_id' => $request->desa_id,
            'foto' => $fotoPaths,
            'dokumen' => $dokumenPaths,
        ]);

        return back()->with('success', 'Berhasil disimpan');
    }

    public function tentang()
    {
        $desas = Desa::with('detailDesa')->get();

        return view('pegawai.tentang', compact('desas'));
    }
}