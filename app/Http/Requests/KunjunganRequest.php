<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KunjunganRequest extends FormRequest
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
            'pasien_id'           => 'required|exists:pasiens,id',
            'waktu_masuk'         => 'nullable|date',

            'pasien_baru'         => 'nullable|boolean',
            'kasus_id'            => 'nullable|exists:kasuses,id',
            'penyakit_id'         => 'nullable|exists:penyakits,id',

            'rujukan.jenis_id'    => 'nullable|exists:jenis_rujukans,id',
            'rujukan.asal'        => 'nullable',
            'rujukan.nomor'       => 'nullable',
            'rujukan.tanggal'     => 'nullable',

            'pj_nama'             => 'nullable|string|max:32',
            'pj_telepon'          => 'nullable|string',

            'cara_pembayaran_id'  => 'nullable|exists:cara_pembayarans,id',
            'sjp_nomor'           => 'nullable',
            'sjp_tanggal'         => 'nullable',
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
            'pasien_id'           => 'pasien',
            'tarif_registrasi_id' => 'jenis registrasi',
            'kasus_id'            => 'kasus',
            'penyakit_id'         => 'penyakit',
            'rujukan.jenis_id'    => 'jenis rujukan',
            'cara_pembayaran_id'  => 'cara pembayaran',
        ];
    }
}
