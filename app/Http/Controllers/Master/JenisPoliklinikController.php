<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Models\Master\JenisPoliklinik;
use App\Http\Resources\Master\Resource;

class JenisPoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return Resource::collection(JenisPoliklinik::filter($query));
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
            JenisPoliklinik::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\JenisPoliklinik  $jenis_poliklinik
     * @return \Illuminate\Http\Response
     */
    public function show(JenisPoliklinik $jenis_poliklinik)
    {
        return new Resource($jenis_poliklinik);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\JenisPoliklinik  $jenis_poliklinik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisPoliklinik $jenis_poliklinik)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            tap($jenis_poliklinik)->update($request->only('uraian'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\JenisPoliklinik  $jenis_poliklinik
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisPoliklinik $jenis_poliklinik)
    {
        return response()->crud(tap($jenis_poliklinik)->delete());
    }
}
