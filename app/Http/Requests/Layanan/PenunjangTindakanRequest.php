<?php

namespace App\Http\Requests\Layanan;

use Illuminate\Foundation\Http\FormRequest;

class PenunjangTindakanRequest extends FormRequest
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
            'penunjang_id'  => 'required|exists:layanan_penunjangs,id',
            'tindakan_id'   => 'required|morph_exists:tindakan_type',
            'tindakan_type' => 'required',
            'waktu'         => 'required',
            'petugas_id'    => 'required|exists:pegawais,id',
            'catatan'       => 'nullable',
        ];
    }
}
