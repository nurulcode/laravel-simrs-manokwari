<?php

namespace App\Http\Controllers\Fasilitas;

use App\Models\Fasilitas\Poliklinik;
use App\Http\Requests\Fasilitas\PoliklinikRequest;
use App\Http\Resources\Fasilitas\PoliklinikResource;
use App\Http\Queries\Fasilitas\PoliklinikQuery;

class PoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PoliklinikQuery $query)
    {
        return PoliklinikResource::collection(
            Poliklinik::with('jenis')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PoliklinikRequest $request)
    {
        return response()->crud(
            new PoliklinikResource(Poliklinik::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fasilitas\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function show(Poliklinik $poliklinik)
    {
        return new PoliklinikResource($poliklinik);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fasilitas\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function update(PoliklinikRequest $request, Poliklinik $poliklinik)
    {
        return response()->crud(
            new PoliklinikResource(tap($poliklinik)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fasilitas\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poliklinik $poliklinik)
    {
        return response()->crud(tap($poliklinik)->delete());
    }
}
