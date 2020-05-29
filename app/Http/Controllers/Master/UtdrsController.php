<?php

namespace App\Http\Controllers\Master;

use App\Models\Master\Utdrs;
use App\Http\Queries\GroupedQuery;
use App\Http\Resources\Master\Resource;
use App\Http\Requests\Master\UtdrsRequest;

class UtdrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupedQuery $query)
    {
        return Resource::collection(Utdrs::with('parent')->filter($query));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UtdrsRequest $request)
    {
        return response()->crud(
            new Resource(Utdrs::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Utdrs  $utdrs
     * @return \Illuminate\Http\Response
     */
    public function show(Utdrs $utdrs)
    {
        return new Resource($utdrs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Utdrs  $utdrs
     * @return \Illuminate\Http\Response
     */
    public function update(UtdrsRequest $request, Utdrs $utdrs)
    {
        return response()->crud(
            new Resource(tap($utdrs)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Utdrs  $utdrs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utdrs $utdrs)
    {
        return response()->crud(tap($utdrs)->delete());
    }
}
