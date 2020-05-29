<?php

namespace App\Models\Layanan;

use App\Models\Master\TipeDiagnosa;
use App\Models\Master\Penyakit\Penyakit;

class Diagnosa extends Layanan
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_diagnosas';

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }

    public function tipe()
    {
        return $this->belongsTo(TipeDiagnosa::class, 'tipe_diagnosa_id');
    }
}
