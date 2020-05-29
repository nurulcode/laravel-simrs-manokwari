<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class StoreTarifController extends Controller
{
    public function __invoke(Request $request)
    {
        $tarifable_type = $request->input('tarifable_type');
        $tarifable_id   = $request->input('tarifable_id');

        $tarifable = call_user_func([$tarifable_type, 'find'], $tarifable_id);

        Tarif::updateOrCreate(
            $request->only(['tarifable_type', 'tarifable_id']),
            $request->only(['tarif'])
        );

        return response()->crud($tarifable);
    }
}
