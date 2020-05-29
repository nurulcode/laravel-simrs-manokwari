<?php

namespace App\Http\Requests\Master;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PerawatanKhususRequest extends FormRequest
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
        $unique = Rule::unique('perawatan_khususes')->ignore(
            optional($this->route('perawatan_khusus'))->id
        );

        return [
            'parent_id' => ['nullable', 'exists:perawatan_khususes,id'],
            'kode'      => ['nullable', $unique],
            'uraian'    => ['required', 'max:128'],
        ];
    }
}
