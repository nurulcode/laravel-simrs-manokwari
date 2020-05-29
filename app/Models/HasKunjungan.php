<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

trait HasKunjungan
{
    protected static function bootHasKunjungan()
    {
        static::creating(function ($model) {
            $model->waktu_masuk = $model->waktu_masuk ?? now();
        });

        static::addGlobalScope('kunjungan', function (Builder $builder) {
            $table = $builder->getQuery()->from;

            $builder->addSubSelect('kunjungan_id', Registrasi::select('kunjungan_id')
                ->where('perawatan_type', get_called_class())
                ->whereColumn('perawatan_id', $table . '.id'));
        });
    }

    public function registrasi()
    {
        return $this->morphOne(Registrasi::class, 'perawatan');
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
}
