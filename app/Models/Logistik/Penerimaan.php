<?php

namespace App\Models\Logistik;

use App\Models\Model;

class Penerimaan extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['tanggal_faktur', 'jatuh_tempo', 'tanggal_terima'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['suplier'];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
    }

    public function transaksis()
    {
        return $this->morphMany(Transaksi::class, 'faktur');
    }
}
