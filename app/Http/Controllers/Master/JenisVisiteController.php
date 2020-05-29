<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Models\Master\JenisVisite;
use App\Http\Resources\Master\Resource;

class JenisVisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return Resource::collection(JenisVisite::filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            JenisVisite::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\JenisVisite  $jenis_visite
     * @return \Illuminate\Http\Response
     */
    public function show(JenisVisite $jenis_visite)
    {
        return new Resource($jenis_visite);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\JenisVisite  $jenis_visite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisVisite $jenis_visite)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            tap($jenis_visite)->update($request->only('uraian'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\JenisVisite  $jenis_visite
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisVisite $jenis_visite)
    {
        return response()->crud(tap($jenis_visite)->delete());
    }
}
