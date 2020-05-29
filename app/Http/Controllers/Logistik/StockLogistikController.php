<?php

namespace App\Http\Controllers\Logistik;

use Sty\HttpQuery;
use Illuminate\Http\Request;
use App\Models\Logistik\Logistik;
use App\Models\Logistik\Transaksi;
use App\Http\Controllers\Controller;
use App\Http\Resources\Logistik\LogistikResource;
use App\Enums\JenisTransaksi;

class StockLogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpQuery $query)
    {
        $transaksi = Transaksi::withoutGlobalScopes()
            ->selectRaw('SUM(jumlah)')
            ->whereColumn('logistiks.id', 'logistik_transaksis.logistik_id')
            ->whereColumn('apotek_id', 'poliklinik_id');

        return LogistikResource::collection(
            Logistik::withoutGlobalScopes()
                ->with('jenis')
                ->select(
                    'logistiks.*',
                    'polikliniks.id as poliklinik_id',
                    'polikliniks.nama as poliklinik'
                )
                ->crossJoin('polikliniks', function ($join) {
                    $join->where('polikliniks.jenis_id', '=', '11');
                })
                ->selectSub($transaksi, 'stock')
                ->filter($query)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $logistik = Logistik::stock()->findOrFail($request->input('logistik_id'));

        $stock    = $logistik->getStock($request->input('apotek_id'));

        $delta     = $request->input('stock') - $stock;

        $logistik->transaksis()->create([
            'jenis'     => JenisTransaksi::KOREKSI,
            'apotek_id' => $request->input('apotek_id'),
            'jumlah'    => $delta
        ]);

        return response()->crud(new LogistikResource($logistik));
    }
}
