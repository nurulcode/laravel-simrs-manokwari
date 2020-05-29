<?php

namespace App\Http\Requests\Master;

use App\Enums\KategoriRegistrasi;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class JenisRegistrasiRequest extends FormRequest
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
            'kategori' => ['required', new EnumValue(KategoriRegistrasi::class)],
            'uraian'   => ['required', 'max:128']
        ];
    }
}
