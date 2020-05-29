<?php

namespace App\Http\Requests\Layanan;

use Illuminate\Foundation\Http\FormRequest;

class KebidananRequest extends FormRequest
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
            'perawatan_id'   => 'required|morph_exists:perawatan_type',
            'perawatan_type' => 'required',
            'kegiatan_id'    => 'required|exists:kegiatans,id',
            'jumlah'         => 'required',
            'waktu'          => 'required',
            'petugas_id'     => 'required|exists:pegawais,id',
        ];
    }
}
