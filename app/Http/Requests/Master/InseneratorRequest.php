<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class InseneratorRequest extends FormRequest
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
            'parent_id' => ['nullable', 'exists:insenerators,id'],
            'kode'      => ['required'],
            'uraian'    => ['required', 'max:128'],
            'satuan'    => ['nullable', 'max:12'],
        ];
    }
}
