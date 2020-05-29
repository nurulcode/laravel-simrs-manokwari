<?php

namespace App\Models\Layanan;

use App\Models\Master;
use App\Models\HasTarif;

class Gizi extends Layanan
{
    use HasTarif;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_gizis';

    public function gizi()
    {
        return $this->belongsTo(Master\Gizi::class);
    }

    public function getTarifReference()
    {
        return $this->gizi;
    }
}
