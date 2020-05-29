<?php

namespace App\Http\Requests\Logistik;

use Illuminate\Foundation\Http\FormRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\GolonganObat;

class LogistikRequest extends FormRequest
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
            'uraian'     => ['required'],
            'satuan'     => ['required'],
            'jenis_id'   => ['required', 'exists:jenis_logistiks,id'],
            'golongan'   => ['nullable', new EnumValue(GolonganObat::class, false)],
            'harga_jual' => ['nullable']
        ];
    }
}
