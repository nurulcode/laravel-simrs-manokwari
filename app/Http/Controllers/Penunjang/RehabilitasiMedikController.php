<?php

namespace App\Http\Controllers\Penunjang;

use App\Enums\TypePenunjang;
use App\Models\Layanan\Penunjang;
use App\Http\Controllers\Controller;

class RehabilitasiMedikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penunjang.index', [
            'title' => 'Pasien Radiologi Management',
            'jenis' => TypePenunjang::REHABILITASI_MEDIK
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Penunjang  $penunjang
     * @return \Illuminate\Http\Response
     */
    public function show(Penunjang $rehabilitasi_medik)
    {
        return view('penunjang.show', [
            'title'     => 'Data Pasien Rehabilitasi Medik Management',
            'tindakan'  => 'kegiatan',
            'kategori'  => 10,
            'penunjang' => $rehabilitasi_medik,
            'kunjungan' => $rehabilitasi_medik->perawatan->kunjungan,
            'perawatan' => $rehabilitasi_medik->perawatan,
        ]);
    }
}
