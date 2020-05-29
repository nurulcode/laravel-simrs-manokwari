<?php

namespace App\Models\Layanan;

use App\Models\Master\PemeriksaanUmum;

class Pemeriksaan extends Layanan
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_pemeriksaans';

    public function pemeriksaan_umum()
    {
        return $this->belongsTo(PemeriksaanUmum::class);
    }
}
