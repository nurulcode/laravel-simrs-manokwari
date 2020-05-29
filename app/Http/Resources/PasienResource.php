<?php

namespace App\Http\Resources;

use App\Http\Resources\Master\Resource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Master\Wilayah\KelurahanResource;
use App\Http\Resources\Master\Wilayah\KecamatanResource;
use App\Http\Resources\Master\Wilayah\KotaKabupatenResource;
use App\Http\Resources\Master\Wilayah\ProvinsiResource;

class PasienResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                 => $this->id,
            'tanggal_registrasi' => (string) $this->tanggal_registrasi,
            'no_rekam_medis'     => $this->no_rekam_medis,
            'nama'               => $this->nama,
            'jenis_identitas_id' => $this->jenis_identitas_id,
            'jenis_identitas'    => Resource::make($this->whenLoaded('jenis_identitas')),
            'nomor_identitas'    => $this->nomor_identitas,
            'jenis_kelamin'      => $this->jenis_kelamin,
            'agama_id'           => $this->agama_id,
            'agama'              => Resource::make($this->whenLoaded('agama')),
            'suku_id'            => $this->suku_id,
            'suku'               => Resource::make($this->whenLoaded('suku')),
            'golongan_darah'     => $this->golongan_darah,
            'tempat_lahir'       => $this->tempat_lahir,
            'tanggal_lahir'      => (string) $this->tanggal_lahir,
            'pekerjaan_id'       => $this->pekerjaan_id,
            'pekerjaan'          => Resource::make($this->whenLoaded('pekerjaan')),
            'pendidikan_id'      => $this->pendidikan_id,
            'pendidikan'         => Resource::make($this->whenLoaded('pendidikan')),

            'alamat'             => $this->alamat,
            'provinsi_id'        => $this->provinsi_id,
            'provinsi'           => ProvinsiResource::make($this->whenLoaded('provinsi')),
            'kota_kabupaten_id'  => $this->kota_kabupaten_id,
            'kota_kabupaten'     => KotaKabupatenResource::make($this->whenLoaded('kota_kabupaten')),
            'kecamatan_id'       => $this->kecamatan_id,
            'kecamatan'          => KecamatanResource::make($this->whenLoaded('kecamatan')),
            'kelurahan_id'       => $this->kelurahan_id,
            'kelurahan'          => KelurahanResource::make($this->whenLoaded('kelurahan')),
            'telepon'            => $this->telepon,

            'nama_ayah'          => $this->nama_ayah,
            'nama_ibu'           => $this->nama_ibu,
            'status_pernikahan'  => $this->status_pernikahan,
            'nama_pasangan'      => $this->nama_pasangan,
            'alamat_keluarga'    => $this->alamat_keluarga,
            'telepon_keluarga'   => $this->telepon_keluarga,

            'path'               => $this->path,
        ];
    }
}
