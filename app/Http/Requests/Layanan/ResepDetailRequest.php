<?php

namespace App\Http\Requests\Layanan;

use Illuminate\Foundation\Http\FormRequest;

class ResepDetailRequest extends FormRequest
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
            'obat_id'        => 'required|exists:logistiks,id',
            'jumlah'         => 'required',
            'aturan_pakai'   => 'required',
            'waktu'          => 'required',
            'petugas_id'     => 'required|exists:pegawais,id',
        ];
    }
}
