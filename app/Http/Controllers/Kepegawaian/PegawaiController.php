<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Models\Kepegawaian\Pegawai;
use App\Http\Requests\Kepegawaian\PegawaiRequest;
use App\Http\Resources\Kepegawaian\PegawaiResource;
use App\Http\Queries\Kepegawaian\PegawaiQuery;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PegawaiQuery $query)
    {
        return PegawaiResource::collection(Pegawai::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {
        return response()->crud(new PegawaiResource(
            Pegawai::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kepegawaian\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        return new PegawaiResource($pegawai);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kepegawaian\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiRequest $request, Pegawai $pegawai)
    {
        return response()->crud(new PegawaiResource(
            tap($pegawai)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kepegawaian\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        return response()->crud(tap($pegawai)->delete());
    }
}
