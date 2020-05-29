<?php

namespace App\Http\Requests\Master\Wilayah;

use App\Models\Master\Wilayah\Provinsi;
use Illuminate\Foundation\Http\FormRequest;

class ProvinsiRequest extends FormRequest
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
        return ['name' => 'required|string|max:64'];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return ['name' => 'nama provinsi'];
    }
}
