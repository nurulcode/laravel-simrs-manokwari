<?php

namespace App\Http\Controllers\Master\Penyakit;

use App\Http\Controllers\Master\Controller;
use App\Models\Master\Penyakit\KelompokPenyakit;
use App\Http\Queries\Master\KelompokPenyakitQuery;
use App\Http\Requests\Master\Penyakit\KelompokPenyakitRequest;
use App\Http\Resources\Master\Penyakit\KelompokPenyakitResource;

class KelompokPenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KelompokPenyakitQuery $query)
    {
        return KelompokPenyakitResource::collection(KelompokPenyakit::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelompokPenyakitRequest $request)
    {
        return response()->crud(
            new KelompokPenyakitResource(
                KelompokPenyakit::create($request->validated())
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Penyakit\KelompokPenyakit  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function show(KelompokPenyakit $kelompok)
    {
        return new KelompokPenyakitResource($kelompok);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Penyakit\KelompokPenyakit  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function update(KelompokPenyakitRequest $request, KelompokPenyakit $kelompok)
    {
        return response()->crud(
            new KelompokPenyakitResource(
                tap($kelompok)->update($request->validated())
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Penyakit\KelompokPenyakit  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function destroy(KelompokPenyakit $kelompok)
    {
        return response()->crud(tap($kelompok)->delete());
    }
}
