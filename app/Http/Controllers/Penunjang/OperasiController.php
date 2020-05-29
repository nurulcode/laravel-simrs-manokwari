<?php

namespace App\Http\Controllers\Penunjang;

use App\Enums\TypePenunjang;
use App\Models\Layanan\Penunjang;
use App\Http\Controllers\Controller;

class OperasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penunjang.index', [
            'title' => 'Pasien Operasi Management',
            'jenis' => TypePenunjang::OPERASI
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Penunjang  $penunjang
     * @return \Illuminate\Http\Response
     */
    public function show(Penunjang $operasi)
    {
        return view('penunjang.show', [
            'title'     => 'Data Pasien Operasi Management',
            'tindakan'  => 'operasi',
            'penunjang' => $operasi,
            'kunjungan' => $operasi->perawatan->kunjungan,
            'perawatan' => $operasi->perawatan,
        ]);
    }
}
