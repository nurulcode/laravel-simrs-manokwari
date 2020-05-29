<?php

namespace App\Models\Perawatan;

use Carbon\Carbon;
use App\Enums\KelasTarif;

class RawatJalan extends Perawatan
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kegiatan_id', 'poliklinik_id', 'waktu_masuk'
    ];

    public function scopeHariIni($query)
    {
        return $query->hari(Carbon::now());
    }

    public function scopeHari($query, $date)
    {
        if (!$date instanceof Carbon) {
            $date = new Carbon($date);
        }

        return $query->whereBetween('waktu_masuk', [
            $date->startOfDay(), $date->copy()->endOfDay()
        ]);
    }

    public function getKelasAttribute()
    {
        return KelasTarif::TARIF_UMUM;
    }
}
