<?php

namespace App\Http\Controllers\Perawatan;

use Illuminate\Http\Request;
use App\Enums\KategoriRegistrasi;
use App\Models\Perawatan\RawatInap;
use App\Http\Controllers\Controller;
use App\Models\Fasilitas\Poliklinik;
use Illuminate\Support\Facades\Gate;
use App\Models\Master\JenisRegistrasi;

class RawatInapWebController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can:manage_rawat_inap')->except('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index  = action('Perawatan\RawatInapWebController@index');
        $api    = action('Perawatan\RawatInapController@index');
        $create = action('Perawatan\RawatInapWebController@create');

        return view('perawatan.rawat-inap.index', compact(['index', 'api', 'create']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::any(['manage_registrasi', 'manage_rawat_inap'])) {
            return abort(403);
        }

        $jenis_registrasis = JenisRegistrasi::where(
            'kategori', KategoriRegistrasi::RAWAT_INAP
        )->get();

        $polikliniks = Poliklinik::where('jenis_id', 3)->get();

        return view('perawatan.rawat-inap.create', [
            'jenis_registrasis' => $jenis_registrasis,
            'kategori_kegiatan' => 1,
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
     * @param  \App\Models\Perawatan\RawatInap  $rawat_inap
     * @return \Illuminate\Http\Response
     */
    public function show(RawatInap $rawat_inap)
    {
        $kamar   = $rawat_inap->kamar->nama;
        $ruangan = $rawat_inap->ruangan->nama;
        $ranjang = $rawat_inap->ranjang->kode;

        $polikliniks = Poliklinik::where('jenis_id', 3)->get();

        return view('perawatan.rawat-inap.show', [
            'perawatan'   => $rawat_inap,
            'kunjungan'   => $rawat_inap->kunjungan,
            'title'       => $ruangan . ' - ' . $kamar . ' - Ranjang: ' . $ranjang,
            'polikliniks' => $polikliniks
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perawatan\RawatInap  $rawat_inap
     * @return \Illuminate\Http\Response
     */
    public function edit(RawatInap $rawat_inap)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perawatan\RawatInap  $rawat_inap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RawatInap $rawat_inap)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perawatan\RawatInap  $rawat_inap
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawatInap $rawat_inap)
    {
        abort(403);
    }
}
