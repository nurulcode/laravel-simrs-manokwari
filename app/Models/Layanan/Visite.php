<?php

namespace App\Models\Layanan;

use App\Models\HasTarif;
use App\Enums\KelasTarif;
use App\Models\Master\JenisVisite;

class Visite extends Layanan
{
    use HasTarif;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_visites';

    public function getTarifReference()
    {
        return $this->jenis_visite;
    }

    public function getTarifKelas()
    {
        return KelasTarif::getKey((string) $this->perawatan->kelas);
    }

    public function jenis_visite()
    {
        return $this->belongsTo(JenisVisite::class);
    }

    public function getUraianAttribute()
    {
        return $this->jenis_visite->uraian;
    }

    public function getSubUraianAttribute()
    {
        return $this->waktu->format('d/m/Y H:i:s');
    }

    public function getJumlahAttribute()
    {
        return 1;
    }
}
