<?php

namespace App\Http\Controllers\Penunjang;

use App\Enums\TypePenunjang;
use App\Models\Layanan\Penunjang;
use App\Http\Controllers\Controller;

class UtdrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penunjang.index', [
            'title' => 'Pasien UTDRS Management',
            'jenis' => TypePenunjang::UTDRS
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Penunjang  $penunjang
     * @return \Illuminate\Http\Response
     */
    public function show(Penunjang $utdrs)
    {
        return view('penunjang.show', [
            'title'     => 'Data Pasien UTDRS Management',
            'tindakan'  => 'utdrs',
            'penunjang' => $utdrs,
            'kunjungan' => $utdrs->perawatan->kunjungan,
            'perawatan' => $utdrs->perawatan,
        ]);
    }
}
