<?php

namespace App\Http\Controllers\Fasilitas;

use App\Models\Fasilitas\Kamar;
use App\Http\Requests\Fasilitas\KamarRequest;
use App\Http\Resources\Fasilitas\KamarResource;
use App\Http\Queries\Fasilitas\KamarQuery;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KamarQuery $query)
    {
        return KamarResource::collection(
            Kamar::with('ruangan', 'poliklinik')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KamarRequest $request)
    {
        return response()->crud(
            new KamarResource(Kamar::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fasilitas\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function show(Kamar $kamar)
    {
        return new KamarResource($kamar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fasilitas\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(KamarRequest $request, Kamar $kamar)
    {
        return response()->crud(
            new KamarResource(tap($kamar)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fasilitas\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kamar $kamar)
    {
        return response()->crud(tap($kamar)->delete());
    }
}
