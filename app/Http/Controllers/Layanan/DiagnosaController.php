<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Layanan\Diagnosa;
use App\Http\Queries\LayananQuery;
use App\Http\Requests\Layanan\DiagnosaRequest;
use App\Http\Resources\Layanan\DiagnosaResource;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananQuery $query)
    {
        return DiagnosaResource::collection(
            Diagnosa::with('petugas', 'penyakit', 'tipe')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiagnosaRequest $request)
    {
        return response()->crud(new DiagnosaResource(
            Diagnosa::create($request->validated())
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Diagnosa  $diagnosa
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnosa $diagnosa)
    {
        return new DiagnosaResource($diagnosa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\Diagnosa  $diagnosa
     * @return \Illuminate\Http\Response
     */
    public function update(DiagnosaRequest $request, Diagnosa $diagnosa)
    {
        return response()->crud(new DiagnosaResource(
            tap($diagnosa)->update($request->validated())
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Diagnosa  $diagnosa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosa $diagnosa)
    {
        return response()->crud(tap($diagnosa)->delete());
    }
}
