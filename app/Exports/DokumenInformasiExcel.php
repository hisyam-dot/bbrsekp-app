<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\DetailDesa;

class DokumenInformasiExcel implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DetailDesa::with('provinsi', 'kabupaten', 'kecamatan', 'desa')
            ->get()
            ->map(function ($item) {
                return [
                    'Provinsi' => $item->provinsi-> nama ?? '-',
                    'Kabupaten' => $item->kabupaten-> nama ?? '-',
                    'Kecamatan' => $item->kecamatan-> nama ?? '-',
                    'Desa' => $item->desa-> nama ?? '-',
                    'Judul' => $item->judul,
                    'Profil' => $item->profil,
                    'Lokasi' => $item->lokasi,

                    // File jadi string
                    'Foto' => implode(', ', $item->foto ?? []),
                    'Bahan Paparan' => implode(', ', $item->bahan_paparan ?? []),
                    'Laporan' => implode(', ', $item->laporan ?? []),
                    'Dokumen' => implode(', ', $item->dokumen ?? []),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Provinsi',
            'Kabupaten',
            'Kecamatan',
            'Desa',
            'Judul',
            'Profil',
            'Lokasi',
            'Foto',
            'Bahan Paparan',
            'Laporan',
            'Dokumen',
        ];
    }
}
