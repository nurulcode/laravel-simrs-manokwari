<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Master\Penyakit\PenyakitResource;
use App\Http\Resources\Master\Resource;

class KunjunganResource extends JsonResource
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
            'id'                  => $this->id,
            'cara_pembayaran_id'  => $this->cara_pembayaran_id,
            'jenis_registrasi_id' => $this->jenis_registrasi_id,
            'kasus'               => Resource::make($this->whenLoaded('kasus')),
            'kasus_id'            => $this->kasus_id,
            'nomor_kunjungan'     => $this->nomor_kunjungan,
            'pasien'              => PasienResource::make($this->whenLoaded('pasien')),
            'pasien_baru'         => $this->pasien_baru,
            'pasien_id'           => $this->pasien_id,
            'penyakit_id'         => $this->penyakit_id,
            'penyakit'            => PenyakitResource::make($this->whenLoaded('penyakit')),
            'pj_nama'             => $this->pj_nama,
            'pj_telepon'          => $this->pj_telepon,
            'sjp_nomor'           => $this->sjp_nomor,
            'sjp_tanggal'         => $this->sjp_tanggal,
            'path'                => $this->path,
            'rujukan'             => $this->rujukan,
            'waktu_masuk'         => (string) $this->waktu_masuk,
            'waktu_keluar'        => (string) $this->waktu_keluar,
        ];
    }
}
