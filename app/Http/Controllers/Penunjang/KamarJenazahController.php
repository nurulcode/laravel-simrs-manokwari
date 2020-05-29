<?php

namespace App\Http\Controllers\Penunjang;

use App\Enums\TypePenunjang;
use App\Models\Layanan\Penunjang;
use App\Http\Controllers\Controller;

class KamarJenazahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penunjang.index', [
            'title' => 'Kamar Jenazah Management',
            'jenis' => TypePenunjang::KAMAR_JENAZAH
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Penunjang  $penunjang
     * @return \Illuminate\Http\Response
     */
    public function show(Penunjang $kamar_jenazah)
    {
        return view('penunjang.show', [
            'title'     => 'Data Pasien Kamar Jenazah Management',
            'tindakan'  => 'kamar-jenazah',
            'penunjang' => $kamar_jenazah,
            'kunjungan' => $kamar_jenazah->perawatan->kunjungan,
            'perawatan' => $kamar_jenazah->perawatan,
        ]);
    }
}
