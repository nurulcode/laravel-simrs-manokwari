<?php

namespace App\Models;

trait HasTarif
{
    abstract public function getTarifReference();

    abstract public function getTarifKelas();

    protected static function bootHasTarif()
    {
        static::creating(function ($model) {
            $master = $model->getTarifReference();
            $kelas  = $model->getTarifKelas();

            if ($master && $kelas) {
                $model->tarif = $master->getTarifByKelas($kelas);
            }
        });
    }

    public function setTarifAttribute($value)
    {
        $this->attributes['tarif'] = json_encode($value);
    }

    public function getTarifAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getTotalTarifAttribute()
    {
        return collect($this->tarif)->sum() * $this->jumlah;
    }
}
