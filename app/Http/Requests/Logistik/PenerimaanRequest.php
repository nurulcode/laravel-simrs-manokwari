<?php

namespace App\Http\Requests\Logistik;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\SistemPembayaran;

class PenerimaanRequest extends FormRequest
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
        $unique = Rule::unique('penerimaans')->ignore(
            optional($this->route('penerimaan'))->id
        );

        return [
            'suplier_id'        => ['required', 'exists:supliers,id'],
            'no_faktur'         => ['required', $unique],
            'sistem_pembayaran' => ['required', new EnumValue(SistemPembayaran::class, false)],
            'tanggal_faktur'    => ['required', 'date'],
            'jatuh_tempo'       => ['required', 'date'],
            'tanggal_terima'    => ['required', 'date'],
        ];
    }
}
