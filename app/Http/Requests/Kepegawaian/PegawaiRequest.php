<?php

namespace App\Http\Requests\Kepegawaian;

use App\Enums\JenisKelamin;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
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
            'kualifikasi_id' => ['required', 'exists:kualifikasis,id'],
            'nama'           => ['required'],
            'jenis_kelamin'  => ['required', new EnumValue(JenisKelamin::class)],
            'jabatan_id'     => ['nullable', 'exists:jabatans,id'],
            'tempat_lahir'   => ['nullable'],
            'tanggal_lahir'  => ['nullable', 'date'],
            'alamat'         => ['nullable'],
            'telepon'        => ['nullable'],
        ];
    }
}
