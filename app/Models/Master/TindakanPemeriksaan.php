<?php

namespace App\Models\Master;

use App\Models\Tarifable;
use App\Models\BelongsToItself;
use App\Models\Fasilitas\Poliklinik;

class TindakanPemeriksaan extends Master
{
    use BelongsToItself, Tarifable;

    public function polikliniks()
    {
        return $this->belongsToMany(Poliklinik::class);
    }

    public function prosedur()
    {
        return $this->belongsTo(Prosedur::class);
    }
}
