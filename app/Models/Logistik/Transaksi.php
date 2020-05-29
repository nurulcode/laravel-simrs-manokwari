<?php

namespace App\Models\Logistik;

use App\Models\Model;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Layanan\Resep;

class Transaksi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logistik_transaksis';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->faktur_type == Resep::class) {
                $model->harga = $model->logistik->harga_jual;
            }
        });
    }

    public function faktur()
    {
        return $this->morphTo();
    }

    public function apotek()
    {
        return $this->belongsTo(Poliklinik::class);
    }

    public function logistik()
    {
        return $this->belongsTo(Logistik::class);
    }

    public function getTotalTarifAttribute()
    {
        return abs($this->jumlah) * $this->harga;
    }
}
