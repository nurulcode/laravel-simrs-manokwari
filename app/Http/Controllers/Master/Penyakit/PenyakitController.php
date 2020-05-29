<?php

namespace App\Http\Controllers\Master\Penyakit;

use App\Models\Master\Penyakit\Penyakit;
use App\Http\Queries\Master\PenyakitQuery;
use App\Http\Controllers\Master\Controller;
use App\Http\Requests\Master\Penyakit\PenyakitRequest;
use App\Http\Resources\Master\Penyakit\PenyakitResource;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PenyakitQuery $query)
    {
        return PenyakitResource::collection(Penyakit::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenyakitRequest $request)
    {
        return response()->crud(
            new PenyakitResource(Penyakit::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Penyakit\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function show(Penyakit $penyakit)
    {
        return new PenyakitResource($penyakit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Penyakit\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function update(PenyakitRequest $request, Penyakit $penyakit)
    {
        return response()->crud(
            new PenyakitResource(tap($penyakit)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Penyakit\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyakit $penyakit)
    {
        return response()->crud(tap($penyakit)->delete());
    }
}
