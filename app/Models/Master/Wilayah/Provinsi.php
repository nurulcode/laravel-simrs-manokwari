<?php

namespace App\Models\Master\Wilayah;

use App\Models\Master\Master;

class Provinsi extends Master
{
    public function kota_kabupaten()
    {
        return $this->hasMany(KotaKabupaten::class);
    }
}
