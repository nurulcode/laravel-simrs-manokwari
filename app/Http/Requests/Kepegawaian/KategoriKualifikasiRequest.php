<?php

namespace App\Http\Requests\Kepegawaian;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class KategoriKualifikasiRequest extends FormRequest
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
        $unique = Rule::unique('kategori_kualifikasis')->ignore(
            optional($this->route('kategori'))->id
        );

        return [
            'kode'            => ['required', $unique],
            'tenaga_medis'    => ['required'],
            'uraian'          => ['required', 'max:255'],
        ];
    }
}
