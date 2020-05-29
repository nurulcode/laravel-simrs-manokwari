<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Layanan\Oksigen;
use App\Http\Queries\LayananQuery;
use App\Http\Requests\Layanan\OksigenRequest;
use App\Http\Resources\Layanan\OksigenResource;

class OksigenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananQuery $query)
    {
        return OksigenResource::collection(
            Oksigen::with('petugas', 'oksigen')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OksigenRequest $request)
    {
        return response()->crud(
            new OksigenResource(Oksigen::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan\Oksigen  $oksigen
     * @return \Illuminate\Http\Response
     */
    public function show(Oksigen $oksigen)
    {
        return new OksigenResource($oksigen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan\Oksigen  $oksigen
     * @return \Illuminate\Http\Response
     */
    public function update(OksigenRequest $request, Oksigen $oksigen)
    {
        return response()->crud(
            new OksigenResource(tap($oksigen)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan\Oksigen  $oksigen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oksigen $oksigen)
    {
        return response()->crud(tap($oksigen)->delete());
    }
}
