<?php

namespace App\Http\Requests\Master;

use App\Models\Master\Kasus;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class KasusRequest extends FormRequest
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
        $unique = Rule::unique('kasuses')->ignore(optional($this->route('kasus'))->id);

        return [
            'kode'   => ['required', $unique],
            'uraian' => ['required', 'max:128']
        ];
    }
}
