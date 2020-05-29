<?php

namespace App\Http\Controllers\Master;

use App\Models\Master\PemeriksaanJenazah;
use Illuminate\Http\Request;
use Sty\HttpQuery;
use App\Http\Resources\Master\Resource;

class PemeriksaanJenazahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return Resource::collection(PemeriksaanJenazah::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            PemeriksaanJenazah::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\PemeriksaanJenazah  $pemeriksaan_jenazah
     * @return \Illuminate\Http\Response
     */
    public function show(PemeriksaanJenazah $pemeriksaan_jenazah)
    {
        return new Resource($pemeriksaan_jenazah);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\PemeriksaanJenazah  $pemeriksaan_jenazah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemeriksaanJenazah $pemeriksaan_jenazah)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            tap($pemeriksaan_jenazah)->update($request->only('uraian'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\PemeriksaanJenazah  $pemeriksaan_jenazah
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemeriksaanJenazah $pemeriksaan_jenazah)
    {
        return response()->crud(tap($pemeriksaan_jenazah)->delete());
    }
}
