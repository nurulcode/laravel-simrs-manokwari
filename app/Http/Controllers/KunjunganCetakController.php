<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;

class KunjunganCetakController extends Controller
{
    public function __invoke(Kunjungan $kunjungan)
    {
        $registrasis = $kunjungan->registrasis()->whereHas('jenis')->get();

        $perawatans  = $kunjungan->registrasis()->whereNotNull('perawatan_id')->get();

        return view('kunjungan.cetak', [
            'kunjungan'   => $kunjungan,
            'registrasis' => $registrasis,
            'perawatans'  => $perawatans->map->perawatan
        ]);
    }
}
