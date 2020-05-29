<?php

namespace App\Models\Layanan;

use App\Models\Master\JenisLaundry;
use App\Models\HasTarif;

class Laundry extends Layanan
{
    use HasTarif;

    public function jenis_laundry()
    {
        return $this->belongsTo(JenisLaundry::class);
    }

    public function getTarifReference()
    {
        return $this->jenis_laundry;
    }
}
