<?php

namespace App\Http\Requests\Perawatan;

class CreateRawatDaruratRequest extends CreateRawatJalanRequest
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
}
