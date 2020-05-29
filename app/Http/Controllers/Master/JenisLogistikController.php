<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Models\Master\JenisLogistik;
use App\Http\Resources\Master\Resource;

class JenisLogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return Resource::collection(
            JenisLogistik::withCount('logistiks')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['uraian' => 'required|max:128']);

        return response()->crud(new Resource(
            JenisLogistik::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\JenisLogistik  $jenis_logistik
     * @return \Illuminate\Http\Response
     */
    public function show(JenisLogistik $jenis_logistik)
    {
        return new Resource($jenis_logistik);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\JenisLogistik  $jenis_logistik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisLogistik $jenis_logistik)
    {
        $request->validate(['uraian' => 'required|max:128']);

        return response()->crud(
            new Resource(tap($jenis_logistik)->update($request->only('uraian')))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\JenisLogistik  $jenis_logistik
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisLogistik $jenis_logistik)
    {
        return response()->crud(tap($jenis_logistik)->delete());
    }
}
