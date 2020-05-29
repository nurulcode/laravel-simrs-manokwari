<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Models\Perawatan\RawatInap;
use App\Models\Perawatan\RawatDarurat;
use App\Models\Perawatan\RawatJalan;
use App\Models\Fasilitas\Ranjang;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', [
            'pasiens'       => Pasien::query(),
            'kunjungans'    => Kunjungan::query(),
            'ranjangs'      => Ranjang::query(),
            'rawat_inap'    => RawatInap::query(),
            'rawat_darurat' => RawatDarurat::query(),
            'rawat_jalan'   => RawatJalan::query()
        ]);
    }
}
