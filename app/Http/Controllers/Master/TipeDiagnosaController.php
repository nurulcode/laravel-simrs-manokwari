<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Models\Master\TipeDiagnosa;
use App\Http\Resources\Master\Resource;

class TipeDiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return Resource::collection(TipeDiagnosa::filter($query));
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
            TipeDiagnosa::create($request->only('uraian'))
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\TipeDiagnosa  $tipe_diagnosa
     * @return \Illuminate\Http\Response
     */
    public function show(TipeDiagnosa $tipe_diagnosa)
    {
        return new Resource($tipe_diagnosa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\TipeDiagnosa  $tipe_diagnosa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipeDiagnosa $tipe_diagnosa)
    {
        $request->validate(['uraian' => 'required|max:255']);

        return response()->crud(new Resource(
            tap($tipe_diagnosa)->update($request->only('uraian'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\TipeDiagnosa  $tipe_diagnosa
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipeDiagnosa $tipe_diagnosa)
    {
        return response()->crud(tap($tipe_diagnosa)->delete());
    }
}
