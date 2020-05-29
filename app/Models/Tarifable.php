<?php

namespace App\Models;

use App\Enums\JenisTarif;
use App\Enums\KelasTarif;
use Illuminate\Database\Eloquent\Builder;

trait Tarifable
{
    public static function bootTarifable()
    {
        static::addGlobalScope('tarif', function (Builder $builder) {
            $builder->addSubSelect('tarif', Tarif::select('tarif')
                ->where('tarifable_type', '=', get_called_class())
                ->whereColumn('tarifable_id', $builder->getQuery()->from . '.id'));
        });
    }

    public function tarif()
    {
        return $this->morphOne(Tarif::class, 'tarifable');
    }

    public function getTarifAttribute($value)
    {
        $data = [];

        foreach (array_wrap($this->kelas_tarif) as $kelas) {
            array_set($data, $kelas, $this->getTarifByKelas($kelas));
        }

        return $data;
    }

    public function getTarifByKelas($kelas)
    {
        $value = json_decode(array_get($this->attributes, 'tarif', ''), true);

        $tarif = array_get($value, $kelas, []);

        $data  = [];

        foreach ($this->jenis_tarif as $jenis) {
            array_set($data, $jenis, array_get($tarif, $jenis, 0));
        }

        return $data;
    }

    public function getKelasTarifAttribute($value)
    {
        return array_unique(KelasTarif::getKeys());
    }

    public function getJenisTarifAttribute()
    {
        return array_unique(JenisTarif::getValues());
    }
}
