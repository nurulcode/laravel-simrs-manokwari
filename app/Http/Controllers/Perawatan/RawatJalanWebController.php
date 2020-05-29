<?php

namespace App\Http\Controllers\Perawatan;

use Illuminate\Http\Request;
use App\Enums\KategoriRegistrasi;
use App\Http\Controllers\Controller;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Perawatan\RawatJalan;
use Illuminate\Support\Facades\Gate;
use App\Models\Master\JenisRegistrasi;

class RawatJalanWebController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can:manage_rawat_jalan')->except('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index  = action('Perawatan\RawatJalanWebController@index');
        $api    = action('Perawatan\RawatJalanController@index');
        $create = action('Perawatan\RawatJalanWebController@create');

        return view('perawatan.rawat-jalan.index', compact(['index', 'api', 'create']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::any(['manage_registrasi', 'manage_rawat_jalan'])) {
            return abort(403);
        }

        $jenis_registrasis = JenisRegistrasi::where(
            'kategori', KategoriRegistrasi::RAWAT_JALAN
        )->get();

        $polikliniks = Poliklinik::where('jenis_id', 1)->get();

        return view('perawatan.rawat-jalan.create', [
            'jenis_registrasis' => $jenis_registrasis,
            'kategori_kegiatan' => 2,
            'polikliniks'       => $polikliniks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perawatan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function show(RawatJalan $rawat_jalan)
    {
        return view('perawatan.rawat-jalan.show', [
            'perawatan' => $rawat_jalan,
            'title'     => $rawat_jalan->poliklinik->nama,
            'kunjungan' => $rawat_jalan->kunjungan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perawatan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function edit(RawatJalan $rawat_jalan)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perawatan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RawatJalan $rawat_jalan)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perawatan\RawatJalan  $rawat_jalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawatJalan $rawat_jalan)
    {
        abort(403);
    }
}
