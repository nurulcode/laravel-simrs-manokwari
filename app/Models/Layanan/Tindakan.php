<?php

namespace App\Models\Layanan;

use App\Models\HasTarif;
use App\Models\Master\TindakanPemeriksaan;
use App\Enums\KelasTarif;

class Tindakan extends Layanan
{
    use HasTarif;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_tindakans';

    public function getTarifReference()
    {
        return $this->tindakan_pemeriksaan;
    }

    public function getTarifKelas()
    {
        return KelasTarif::getKey((string) $this->perawatan->kelas);
    }

    public function tindakan_pemeriksaan()
    {
        return  $this->belongsTo(TindakanPemeriksaan::class);
    }

    public function getUraianAttribute()
    {
        return $this->tindakan_pemeriksaan->uraian;
    }
}
