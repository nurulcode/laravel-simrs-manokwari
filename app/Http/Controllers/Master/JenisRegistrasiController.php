<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use App\Models\Master\JenisRegistrasi;
use App\Http\Requests\Master\JenisRegistrasiRequest;
use App\Http\Resources\Master\JenisRegistrasiResource;

class JenisRegistrasiController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(HttpQuery $query)
    {
        return JenisRegistrasiResource::collection(JenisRegistrasi::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisRegistrasiRequest $request)
    {
        return response()->crud(new JenisRegistrasiResource(
            JenisRegistrasi::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\JenisRegistrasi  $jenis_registrasi
     * @return \Illuminate\Http\Response
     */
    public function show(JenisRegistrasi $jenis_registrasi)
    {
        return new JenisRegistrasiResource($jenis_registrasi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\JenisRegistrasi  $jenis_registrasi
     * @return \Illuminate\Http\Response
     */
    public function update(JenisRegistrasiRequest $request, JenisRegistrasi $jenis_registrasi)
    {
        return response()->crud(new JenisRegistrasiResource(
            tap($jenis_registrasi)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\JenisRegistrasi  $jenis_registrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisRegistrasi $jenis_registrasi)
    {
        return response()->crud(tap($jenis_registrasi)->delete());
    }
}
