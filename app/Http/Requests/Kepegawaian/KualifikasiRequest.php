<?php

namespace App\Http\Requests\Kepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class KualifikasiRequest extends FormRequest
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
            'kategori_id' => ['required', 'exists:kategori_kualifikasis,id'],
            'kode'        => ['required'],
            'uraian'      => ['required', 'max:255'],
            'laki_laki'   => ['required', 'numeric', 'integer'],
            'perempuan'   => ['required', 'numeric', 'integer'],
        ];
    }
}
