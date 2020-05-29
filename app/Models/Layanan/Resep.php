<?php

namespace App\Models\Layanan;

use App\Models\Logistik\Logistik;
use App\Models\Logistik\Transaksi;

class Resep extends Layanan
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_reseps';

    public function obat()
    {
        return $this->belongsTo(Logistik::class);
    }

    public function details()
    {
        return $this->hasMany(ResepDetail::class);
    }

    public function obats()
    {
        return $this->morphMany(Transaksi::class, 'faktur');
    }

    public function getTotalBiaya()
    {
        return $this->obats->sum('total_tarif');
    }
}
