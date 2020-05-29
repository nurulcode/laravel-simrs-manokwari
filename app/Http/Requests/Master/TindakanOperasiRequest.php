<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\JenisOperasi;

class TindakanOperasiRequest extends FormRequest
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
            'parent_id' => ['nullable', 'exists:tindakan_operasis,id'],
            'kode'      => ['required'],
            'uraian'    => ['required', 'max:128'],
            'jenis'     => ['nullable', new EnumValue(JenisOperasi::class)]
        ];
    }
}
