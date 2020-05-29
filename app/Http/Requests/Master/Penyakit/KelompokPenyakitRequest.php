<?php

namespace App\Http\Requests\Master\Penyakit;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Master\Penyakit\KelompokPenyakit;

class KelompokPenyakitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('kelompok')) {
            return $this->user()->can('update', $this->route('kelompok'));
        }

        return $this->user()->can('create', KelompokPenyakit::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $unique = Rule::unique('kelompok_penyakits')->ignore(
            optional($this->route('kelompok'))->id
        );

        return [
            'kode'           => ['required', $unique],
            'icd'            => ['required', $unique],
            'klasifikasi_id' => ['nullable', 'exists:klasifikasi_penyakits,id'],
            'uraian'         => ['required', 'max:128'],
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
            'klasifikasi_id' => 'klasifikasi',
        ];
    }
}
