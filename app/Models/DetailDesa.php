<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailDesa extends Model
{
    protected $fillable = [
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'lokasi',
        'profil_desa',
        'foto',
        'bahan_paparan',
        'laporan',
        'dokumen',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'foto' => 'array',
        'bahan_paparan' => 'array',
        'laporan' => 'array',
        'dokumen' => 'array',
    ];

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
