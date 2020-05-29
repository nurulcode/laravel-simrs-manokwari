<?php

namespace App\Http\Controllers\Master;

use App\Http\Queries\GroupedQuery;
use App\Models\Master\Insenerator;
use App\Http\Requests\Master\InseneratorRequest;
use App\Http\Resources\Master\InseneratorResource;

class InseneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupedQuery $query)
    {
        return InseneratorResource::collection(
            Insenerator::with('parent')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InseneratorRequest $request)
    {
        return response()->crud(
            new InseneratorResource(Insenerator::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Insenerator  $insenerator
     * @return \Illuminate\Http\Response
     */
    public function show(Insenerator $insenerator)
    {
        return new InseneratorResource($insenerator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Insenerator  $insenerator
     * @return \Illuminate\Http\Response
     */
    public function update(InseneratorRequest $request, Insenerator $insenerator)
    {
        return response()->crud(
            new InseneratorResource(tap($insenerator)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Insenerator  $insenerator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insenerator $insenerator)
    {
        return response()->crud(tap($insenerator)->delete());
    }
}
