<?php

namespace App\Models\Kepegawaian;

use App\Models\Model;

class Pegawai extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['tanggal_lahir'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['jabatan', 'kualifikasi'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function kualifikasi()
    {
        return $this->belongsTo(Kualifikasi::class);
    }
}
