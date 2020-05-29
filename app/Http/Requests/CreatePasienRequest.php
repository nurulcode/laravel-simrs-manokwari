<?php

namespace App\Http\Requests;

use App\Enums;
use Sty\RequestTransform;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class CreatePasienRequest extends FormRequest
{
    use RequestTransform;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Pasien::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jenis_identitas_id' => ['required', 'exists:jenis_identitas,id'],
            'nomor_identitas'    => ['required'],
            'nama'               => ['required'],
            'jenis_kelamin'      => ['required', new EnumValue(Enums\JenisKelamin::class)],
            'tempat_lahir'       => ['nullable'],
            'tanggal_lahir'      => ['nullable'],
            'golongan_darah'     => ['nullable'],
            'agama_id'           => ['nullable', 'exists:agamas,id'],
            'suku_id'            => ['nullable', 'exists:sukus,id'],
            'pendidikan_id'      => ['nullable', 'exists:pendidikans,id'],
            'pekerjaan_id'       => ['nullable', 'exists:pekerjaans,id'],
            'alamat'             => ['nullable'],
            'kelurahan_id'       => ['nullable', 'exists:kelurahans,id'],
            'telepon'            => ['nullable'],
            'nama_ayah'          => ['nullable'],
            'nama_ibu'           => ['nullable'],
            'alamat_keluarga'    => ['nullable'],
            'telepon_keluarga'   => ['nullable'],
            'status_pernikahan'  => ['nullable', new EnumValue(Enums\StatusPernikahan::class)],
            'nama_pasangan'      => ['nullable'],
        ];
    }

    public function with()
    {
        return ['tanggal_registrasi' => now()];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'jenis_identitas_id' => 'jenis identitas',
            'agama_id'           => 'agama',
            'suku_id'            => 'suku',
            'pendidikan_id'      => 'pendidikan',
            'pekerjaan_id'       => 'pekerjaan',
            'kelurahan_id'       => 'kelurahan',
        ];
    }
}
