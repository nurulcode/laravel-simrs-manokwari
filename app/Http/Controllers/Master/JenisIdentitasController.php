<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Models\Master\JenisIdentitas;
use App\Http\Resources\Master\Resource;

class JenisIdentitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return Resource::collection(JenisIdentitas::filter($query));
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
            JenisIdentitas::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\JenisIdentitas  $jenis_identita
     * @return \Illuminate\Http\Response
     */
    public function show(JenisIdentitas $jenis_identita)
    {
        return new Resource($jenis_identita);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\JenisIdentitas  $jenis_identita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisIdentitas $jenis_identita)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            tap($jenis_identita)->update($request->only('uraian'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\JenisIdentitas  $jenis_identita
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisIdentitas $jenis_identita)
    {
        return response()->crud(tap($jenis_identita)->delete());
    }
}
