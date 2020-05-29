<?php

namespace App\Models\Fasilitas;

use App\Models\Model;
use App\Models\Master\JenisPoliklinik;

class Poliklinik extends Model
{
    public function jenis()
    {
        return $this->belongsTo(JenisPoliklinik::class);
    }

    public function ruangans()
    {
        return $this->hasMany(Ruangan::class);
    }
}
