<?php

namespace App\Http\Controllers\Master\Wilayah;

use Sty\HttpQuery;
use App\Models\Master\Wilayah\Provinsi;
use App\Http\Controllers\Master\Controller;
use App\Http\Requests\Master\Wilayah\ProvinsiRequest;
use App\Http\Resources\Master\Wilayah\ProvinsiResource;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return ProvinsiResource::collection(Provinsi::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinsiRequest $request)
    {
        return response()->crud(
            new ProvinsiResource(Provinsi::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Wilayah\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show(Provinsi $provinsi)
    {
        return new ProvinsiResource($provinsi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Wilayah\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinsiRequest $request, Provinsi $provinsi)
    {
        return response()->crud(
            new ProvinsiResource(tap($provinsi)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Wilayah\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provinsi $provinsi)
    {
        return response()->crud(tap($provinsi)->delete());
    }
}
