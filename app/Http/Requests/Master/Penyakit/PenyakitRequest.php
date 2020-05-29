<?php

namespace App\Http\Requests\Master\Penyakit;

use Illuminate\Validation\Rule;
use App\Models\Master\Penyakit\Penyakit;
use Illuminate\Foundation\Http\FormRequest;

class PenyakitRequest extends FormRequest
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
        $unique = Rule::unique('penyakits')->ignore(
            optional($this->route('penyakit'))->id
        );

        return [
            'icd'            => ['required', $unique],
            'uraian'         => ['required', 'max:128'],
            'klasifikasi_id' => ['nullable', 'exists:klasifikasi_penyakits,id'],
            'kelompok_id'    => ['nullable', 'exists:kelompok_penyakits,id'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'kelompok_id' => 'kelompok',
        ];
    }
}
