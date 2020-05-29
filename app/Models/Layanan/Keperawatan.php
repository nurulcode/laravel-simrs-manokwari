<?php

namespace App\Models\Layanan;

use App\Models\HasTarif;
use App\Enums\KelasTarif;
use App\Models\Master\PerawatanKhusus;

class Keperawatan extends Layanan
{
    use HasTarif;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_keperawatans';

    public function perawatan_khusus()
    {
        return $this->belongsTo(PerawatanKhusus::class);
    }

    public function getTarifKelas()
    {
        return KelasTarif::getKey((string) $this->perawatan->kelas);
    }

    public function getTarifReference()
    {
        return $this->perawatan_khusus;
    }

    public function getUraianAttribute()
    {
        return $this->perawatan_khusus->uraian;
    }
}
