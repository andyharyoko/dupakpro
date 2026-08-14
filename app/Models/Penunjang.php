<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penunjang extends Model
{

    protected $fillable = [
        'user_id',
        'uraian_kegiatan',
        'semester',
        'tanggal',
        'satuan_hasil',
        'volume',
        'angka_kredit',
        'jumlah_angka_kredit',
        'keterangan',
    ];

    //

    public function buktis()
    {
        return $this->morphMany(Bukti::class, 'buktiable');
    }
}