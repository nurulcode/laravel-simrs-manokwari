<?php

namespace App\Models\Kepegawaian;

use App\Models\Model;

class Kualifikasi extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['kategori'];

    public function kategori()
    {
        return $this->belongsTo(KategoriKualifikasi::class);
    }

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
