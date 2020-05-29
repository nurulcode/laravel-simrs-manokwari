<?php

namespace App\Http\Requests;

use App\Enums;
use Illuminate\Validation\Rule;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('pasien'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $unique = Rule::unique('pasiens')->ignore(optional($this->route('pasien'))->id);

        return [
            'jenis_identitas_id' => ['required', 'exists:jenis_identitas,id'],
            'nomor_identitas'    => ['required'],
            'no_rekam_medis'     => ['required', $unique],
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
