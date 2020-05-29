<?php

namespace App\Http\Controllers\Master;

use Sty\HttpQuery;
use App\Models\Master\Prosedur;
use App\Http\Resources\Master\Resource;
use App\Http\Requests\Master\ProsedurRequest;

class ProsedurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        return Resource::collection(Prosedur::with('parent')->filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProsedurRequest $request)
    {
        return response()->crud(
            new Resource(Prosedur::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Prosedur  $prosedur
     * @return \Illuminate\Http\Response
     */
    public function show(Prosedur $prosedur)
    {
        return new Resource($prosedur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Prosedur  $prosedur
     * @return \Illuminate\Http\Response
     */
    public function update(ProsedurRequest $request, Prosedur $prosedur)
    {
        return response()->crud(
            new Resource(tap($prosedur)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Prosedur  $prosedur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prosedur $prosedur)
    {
        return response()->crud(tap($prosedur)->delete());
    }
}
