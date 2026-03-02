<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PegawaiController extends Controller
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

        return view('pegawai.index', compact('desas', 'search'));
    }

    public function show(Desa $desa)
    {
        $desa->load('detailDesa', 'kecamatan.kabupaten.provinsi');

        return view('pegawai.desa', compact('desa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'bahan_paparan.*' => 'nullable|mimes:pdf,doc,docx,xsl,xlsx',
            'laporan.*' => 'nullable|mimes:pdf,doc,docx,xsl,xlsx',
            'dokumen.*' => 'nullable|mimes:pdf,doc,docx,xsl,xlsx',
        ]);

        $fotoPaths = [];
        if ($request->hasFile('foto')) {

            foreach ($request->file('foto') as $foto) {

                $namaAsli = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = $foto->getClientOriginalExtension();

                $namaBersih = Str::slug($namaAsli);

                $namaFinal = $namaBersih . '-' . time() . '-' . uniqid() . '.' . $ext;

                $fotoPaths[] = $foto->storeAs(
                    'fotos',
                    $namaFinal,
                    'public'  
                );
            }
        }

        $dokumenPaths = [];
        if ($request->hasFile('bahan_paparan')) {

            foreach ($request->file('bahan_paparan')as $dok) {

                $namaAsli = pathinfo($dok->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = $dok->getClientOriginalExtension();

                $namaBersih = Str::slug($namaAsli);

                $namaFinal = $namaBersih . '-' . time(). '-' . uniqid() . '.' . $ext;

                $dokumenPaths[] = $dok->storeAs(
                    'bahan_paparans',
                    $namaFinal,
                    'public'
                );
            }
        }

        $dokumenPaths = [];
        if ($request->hasFile('laporan')) {

            foreach ($request->file('laporan') as $dok) {
                $nama = Str::slug(pathinfo($dok->getClientOriginalName(), PATHINFO_FILENAME));
                $ext = $dok->getClientOriginalExtension();

                $namaFinal = $nama . '.' . $ext;

                $dokumenPaths[] = $dok->storeAs(
                    'laporans',
                    $namaFinal,
                    'public'
                );
            }
        }

        $dokumenPaths = [];
        if ($request->hasFile('dokumen')) {

            foreach ($request->file('dokumen') as $dok) {

                $nama = Str::slug(pathinfo($dok->getClientOriginalName(), PATHINFO_FILENAME));
                $ext = $dok->getClientOriginalExtension();

                $namaFinal = $nama . '.' . $ext;

                $dokumenPaths[] = $dok->storeAs(
                    'dokumens',
                    $namaFinal,
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
        return view('pegawai.tentang');
    }
}