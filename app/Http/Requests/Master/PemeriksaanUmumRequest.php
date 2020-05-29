<?php

namespace App\Http\Requests\Master;

use Illuminate\Validation\Rule;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\PeriodePemeriksaan;

class PemeriksaanUmumRequest extends FormRequest
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
        $unique = Rule::unique('pemeriksaan_umums')->ignore(
            optional($this->route('pemeriksaan_umum'))->id
        );

        return [
            'kode'      => ['required', $unique],
            'uraian'    => ['required', 'max:128'],
            'periode'   => ['required', new EnumValue(PeriodePemeriksaan::class)],
            'parent_id' => ['nullable', 'exists:pemeriksaan_umums,id'],
            'satuan'    => ['nullable'],
        ];
    }
}
