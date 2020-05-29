<?php

namespace App\Http\Controllers\Penunjang;

use App\Enums\TypePenunjang;
use App\Models\Layanan\Penunjang;
use App\Http\Controllers\Controller;

class RadiologiController extends Controller
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
            'jenis' => TypePenunjang::RADIOLOGI
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Penunjang  $penunjang
     * @return \Illuminate\Http\Response
     */
    public function show(Penunjang $radiologi)
    {
        return view('penunjang.show', [
            'title'     => 'Data Pasien Radiologi Management',
            'tindakan'  => 'kegiatan',
            'kategori'  => 8,
            'penunjang' => $radiologi,
            'kunjungan' => $radiologi->perawatan->kunjungan,
            'perawatan' => $radiologi->perawatan,
        ]);
    }
}
