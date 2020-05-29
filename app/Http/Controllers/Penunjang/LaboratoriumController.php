<?php

namespace App\Http\Controllers\Penunjang;

use App\Models\Layanan\Penunjang;
use App\Http\Controllers\Controller;
use App\Enums\TypePenunjang;

class LaboratoriumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penunjang.index', [
            'title' => 'Pasien Laboratorium Management',
            'jenis' => TypePenunjang::LABORATORIUM
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Penunjang  $penunjang
     * @return \Illuminate\Http\Response
     */
    public function show(Penunjang $laboratorium)
    {
        return view('penunjang.show', [
            'title'     => 'Data Pasien Laboratorium Management',
            'tindakan'  => 'kegiatan',
            'kategori'  => 9,
            'penunjang' => $laboratorium,
            'kunjungan' => $laboratorium->perawatan->kunjungan,
            'perawatan' => $laboratorium->perawatan,
        ]);
    }
}
