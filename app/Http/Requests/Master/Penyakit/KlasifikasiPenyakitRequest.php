<?php

namespace App\Http\Requests\Master\Penyakit;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class KlasifikasiPenyakitRequest extends FormRequest
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
        $unique = Rule::unique('klasifikasi_penyakits')->ignore(
            optional($this->route('klasifikasi'))->id
        );

        return [
            'kode'   => ['required', $unique],
            'uraian' => ['required', 'max:128']
        ];
    }
}
