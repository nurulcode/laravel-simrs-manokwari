<?php

namespace App\Http\Requests\Master;

use Illuminate\Validation\Rule;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\JenisTindakanPemeriksaan;
use Illuminate\Foundation\Http\FormRequest;

class TindakanPemeriksaanRequest extends FormRequest
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
        $unique = Rule::unique('tindakan_pemeriksaans')->ignore(
            optional($this->route('tindakan_pemeriksaan'))->id
        );

        return [
            'kode'             => ['required', $unique],
            'parent_id'        => ['nullable', 'exists:tindakan_pemeriksaans,id'],
            'prosedur_id'      => ['nullable', 'exists:prosedurs,id'],
            'uraian'           => ['required', 'max:128'],
            'jenis'            => ['required', new EnumValue(JenisTindakanPemeriksaan::class)],
            'polikliniks.*.id' => ['nullable', 'exists:polikliniks']
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return ['parent_id' => 'parent'];
    }
}
