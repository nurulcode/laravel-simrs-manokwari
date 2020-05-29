<?php

namespace App\Http\Controllers\Penunjang;

use App\Http\Controllers\Controller;
use App\Models\Layanan\Resep;

class ApotekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('apotek.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function show(Resep $apotek)
    {
        return view('apotek.show', [
            'title'     => 'Apotek Pasien Perawatan',
            'resep'     => $apotek,
            'kunjungan' => $apotek->perawatan->kunjungan,
            'perawatan' => $apotek->perawatan,
        ]);
    }
}
