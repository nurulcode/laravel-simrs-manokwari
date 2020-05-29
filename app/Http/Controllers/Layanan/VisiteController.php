<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Layanan\Visite;
use App\Http\Queries\LayananQuery;
use App\Http\Requests\Layanan\VisiteRequest;
use App\Http\Resources\Layanan\VisiteResource;

class VisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananQuery $query)
    {
        return VisiteResource::collection(
            Visite::with(['petugas', 'jenis_visite'])->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Layanan\VisiteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisiteRequest $request)
    {
        return response()->crud(
            new VisiteResource(Visite::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Visite  $visite
     * @return \Illuminate\Http\Response
     */
    public function show(Visite $visite)
    {
        return new VisiteResource($visite);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Layanan\VisiteRequest  $request
     * @param  \App\Models\Layanan\Visite  $visite
     * @return \Illuminate\Http\Response
     */
    public function update(VisiteRequest $request, Visite $visite)
    {
        $visite->update($request->validated());

        return response()->crud(new VisiteResource($visite));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Visite  $visite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visite $visite)
    {
        return response()->crud(tap($visite)->delete());
    }
}
