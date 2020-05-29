<?php

namespace App\Http\Controllers\Logistik;

use App\Models\Logistik\Logistik;
use App\Models\Logistik\Transaksi;
use App\Http\Queries\Logistik\TransaksiQuery;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Logistik\TransaksiRequest;
use App\Http\Resources\Logistik\TransaksiResource;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransaksiQuery $query)
    {
        return TransaksiResource::collection(
            Transaksi::with('faktur', 'apotek', 'logistik')->filter($query)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiRequest $request)
    {
        $logistik = Logistik::stock()->findOrFail($request->input('logistik_id'));

        $stock    = $logistik->getStock($request->input('apotek_id'));

        if ($stock + $request->input('jumlah') < 0) {
            throw ValidationException::withMessages([
                'jumlah' => ['Stock tidak mencukupi'],
            ]);
        }

        return response()->crud(
            new TransaksiResource(Transaksi::create($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logistik\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        return new TransaksiResource($transaksi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logistik\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(TransaksiRequest $request, Transaksi $transaksi)
    {
        return response()->crud(
            new TransaksiResource(tap($transaksi)->update($request->validated()))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logistik\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        return response()->crud(tap($transaksi)->delete());
    }
}
