<?php

namespace App\Models\Master\Penyakit;

use App\Models\Master\Master;

class KlasifikasiPenyakit extends Master
{
    public function kelompok()
    {
        return $this->hasMany(KelompokPenyakit::class, 'klasifikasi_id');
    }
}
