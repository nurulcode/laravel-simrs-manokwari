<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Queries\LayananQuery;
use App\Models\Layanan\Perinatologi;
use App\Http\Requests\Layanan\PerinatologiRequest;
use App\Http\Resources\Layanan\PerinatologiResource;

class PerinatologiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananQuery $query)
    {
        return PerinatologiResource::collection(
            Perinatologi::with('petugas', 'kegiatan')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerinatologiRequest $request)
    {
        return response()->crud(
            new PerinatologiResource(Perinatologi::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Perinatologi  $perinatologi
     * @return \Illuminate\Http\Response
     */
    public function show(Perinatologi $perinatologi)
    {
        return new PerinatologiResource($perinatologi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\Perinatologi  $perinatologi
     * @return \Illuminate\Http\Response
     */
    public function update(PerinatologiRequest $request, Perinatologi $perinatologi)
    {
        return response()->crud(
            new PerinatologiResource(tap($perinatologi)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Perinatologi  $perinatologi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perinatologi $perinatologi)
    {
        return response()->crud(tap($perinatologi)->delete());
    }
}
