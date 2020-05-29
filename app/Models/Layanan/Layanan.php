<?php

namespace App\Models\Layanan;

use App\Models\Model;
use App\Enums\KelasTarif;
use App\Models\Kepegawaian\BelongsToPegawai;

abstract class Layanan extends Model
{
    use BelongsToPegawai;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu'];

    public function perawatan()
    {
        return $this->morphTo();
    }

    public function getTarifKelas()
    {
        return KelasTarif::getKey((string) $this->perawatan->kelas);
    }
}
