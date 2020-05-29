<?php

namespace App\Http\Controllers\Penunjang;

use App\Enums\TypePenunjang;
use App\Models\Layanan\Penunjang;
use App\Http\Controllers\Controller;

class InseneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penunjang.index', [
            'title' => 'Pasien Insenerator Management',
            'jenis' => TypePenunjang::INSENERATOR
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Penunjang  $penunjang
     * @return \Illuminate\Http\Response
     */
    public function show(Penunjang $insenerator)
    {
        return view('penunjang.show', [
            'title'     => 'Data Pasien Insenerator Management',
            'tindakan'  => 'insenerator',
            'penunjang' => $insenerator,
            'kunjungan' => $insenerator->perawatan->kunjungan,
            'perawatan' => $insenerator->perawatan,
        ]);
    }
}
