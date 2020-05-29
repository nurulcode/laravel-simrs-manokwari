<?php

namespace App\Models\Layanan;

trait HasLayananKamar
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function bootHasLayananKamar()
    {
        static::created(function ($model) {
            $model->layanan_kamar()->create([
                'ranjang_id'  => $model->ranjang_id,
                'waktu_masuk' => $model->waktu_masuk
            ]);
        });
    }

    public function initializeHasLayananKamar()
    {
        array_set($this->tarifable_layanan,  'layanan_kamar', 'Layanan Kamar');
    }

    public function layanan_kamar()
    {
        return $this->morphOne(Kamar::class, 'perawatan');
    }
}
