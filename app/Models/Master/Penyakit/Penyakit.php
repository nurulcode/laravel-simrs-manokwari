<?php

namespace App\Models\Master\Penyakit;

use App\Models\Master\Master;

class Penyakit extends Master
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['kelompok'];

    public function kelompok()
    {
        return $this->belongsTo(KelompokPenyakit::class);
    }
}
