<?php

namespace App\Models\Layanan;

use App\Models\HasTarif;
use App\Models\Fasilitas\BelongsToRanjang;

class Kamar extends Layanan
{
    use BelongsToRanjang, HasTarif;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_kamars';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['waktu_masuk', 'waktu_keluar'];

    public function path($action = 'show')
    {
        return;
    }

    public function getTarifReference()
    {
        return $this->ranjang->ruangan;
    }

    public function getTarifKelas()
    {
        return $this->ranjang->ruangan->kelas_tarif;
    }

    public function getUraianAttribute()
    {
        $poliklinik = $this->ranjang->poliklinik->nama;
        $ruangan    = $this->ranjang->ruangan->nama;

        return "{$poliklinik} - {$ruangan}";
    }

    public function getSubUraianAttribute()
    {
        $masuk  = $this->waktu_masuk->format('d/m/Y H:i:s');

        $keluar = $this->waktu_keluar ? $this->waktu_keluar : now();

        // return dd($this->waktu_masuk->diffInDays($keluar));

        $keluar = $keluar->format('d/m/Y H:i:s');

        return "{$masuk} - {$keluar}";
    }

    public function getJumlahAttribute()
    {
        $keluar = $this->waktu_keluar ? $this->waktu_keluar : now();

        return $this->waktu_masuk->diffInDays($keluar) + 1;
    }
}
