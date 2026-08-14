<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukti extends Model
{
    use HasFactory;

    protected $fillable = [
        'deskripsi',
        'link_gdrive',
        'buktiable_id',
        'buktiable_type'
    ];

    public function buktiable()
    {
        return $this->morphTo();
    }
}
