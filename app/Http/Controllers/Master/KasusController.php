<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use App\Models\Master\Kasus;
use App\Http\Requests\Master\KasusRequest;
use App\Http\Resources\Master\Resource;

class KasusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return Resource::collection(Kasus::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KasusRequest $request)
    {
        return response()->crud(
            new Resource(Kasus::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function show(Kasus $kasus)
    {
        return new Resource($kasus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function update(KasusRequest $request, Kasus $kasus)
    {
        return response()->crud(
            new Resource(tap($kasus)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kasus $kasus)
    {
        return response()->crud(tap($kasus)->delete());
    }
}
