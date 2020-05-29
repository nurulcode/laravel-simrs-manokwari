<?php

namespace App\Http\Controllers\Logistik;

use Illuminate\Http\Request;
use App\Enums\JenisTransaksi;
use App\Models\Logistik\Logistik;
use App\Http\Controllers\Controller;
use App\Http\Resources\Logistik\LogistikResource;

class TransferLogistikController extends Controller
{
    public function __invoke(Request $request)
    {
        $logistik = Logistik::stock()->findOrFail($request->input('logistik_id'));

        $stock    = $logistik->getStock($request->input('apotek_id'));

        $request->validate([
            'tujuan_id' => 'required|exists:polikliniks,id',
            'transfer'  => 'required|integer|max:' . $stock
        ]);

        $logistik->transaksis()->create([
            'jenis'     => JenisTransaksi::TRANSFER,
            'apotek_id' => $request->input('apotek_id'),
            'jumlah'    => -$request->input('transfer')
        ]);

        $logistik->transaksis()->create([
            'jenis'     => JenisTransaksi::TRANSFER,
            'apotek_id' => $request->input('tujuan_id'),
            'jumlah'    => $request->input('transfer')
        ]);

        return response()->crud(new LogistikResource($logistik));
    }
}
