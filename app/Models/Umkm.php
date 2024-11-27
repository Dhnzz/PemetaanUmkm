<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo};

class Umkm extends Model
{
    protected $fillable = [
        'pemilik_id',
        'name',
        'sku', //File
        'ktp', //File
        'kk', //File
        'foto_usaha', //File
        'modal_awal',
        'jenis_usaha_id',
        'tahun_berdiri',
        'tenaga_kerja',
        'pembayaran_digital',
        'long',
        'lat',
    ];

    public function jenis_usaha(): BelongsTo
    {
        return $this->belongsTo(JenisUsaha::class);
    }

    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(Pemilik::class);
    }
}
