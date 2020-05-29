<?php

namespace App\Http\Requests\Logistik;

use Illuminate\Foundation\Http\FormRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\JenisTransaksi;

class TransaksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jenis'       => ['required', new EnumValue(JenisTransaksi::class, false)],
            'faktur_type' => 'required',
            'faktur_id'   => 'required|morph_exists:faktur_type',
            'apotek_id'   => 'required|exists:polikliniks,id',
            'logistik_id' => 'required|exists:logistiks,id',
            'harga'       => 'nullable',
            'jumlah'      => 'required',
        ];
    }
}
