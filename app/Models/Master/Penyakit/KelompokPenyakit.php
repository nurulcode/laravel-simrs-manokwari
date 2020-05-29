<?php

namespace App\Models\Master\Penyakit;

use App\Models\Master\Master;

class KelompokPenyakit extends Master
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['klasifikasi'];

    public function klasifikasi()
    {
        return $this->belongsTo(KlasifikasiPenyakit::class);
    }

    public function penyakit()
    {
        return $this->hasMany(Penyakit::class, 'kelompok_id');
    }
}
