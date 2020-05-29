<?php

namespace App\Http\Requests\Layanan;

use App\Enums\KasusDiagnosa;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class DiagnosaRequest extends FormRequest
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
            'perawatan_id'     => 'required|morph_exists:perawatan_type',
            'perawatan_type'   => 'required',
            'waktu'            => 'required|date',
            'penyakit_id'      => 'required|exists:penyakits,id',
            'lama_menderita'   => 'nullable',
            'tipe_diagnosa_id' => 'required|exists:tipe_diagnosas,id',
            'petugas_id'       => 'required|exists:pegawais,id',
            'kasus'            => ['required', new EnumValue(KasusDiagnosa::class)],
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
            'penyakit_id'      => 'penyakit',
            'tipe_diagnosa_id' => 'tipe',
            'petugas_id'       => 'petugas',
        ];
    }
}
