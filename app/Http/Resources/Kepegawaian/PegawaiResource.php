<?php

namespace App\Http\Resources\Kepegawaian;

use App\Http\Resources\Master\Resource;
use Illuminate\Http\Resources\Json\JsonResource;

class PegawaiResource extends JsonResource
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
            'id'             => $this->id,
            'kualifikasi_id' => $this->kualifikasi_id,
            'kualifikasi'    => KualifikasiResource::make($this->whenLoaded('kualifikasi')),
            'nama'           => $this->nama,
            'tempat_lahir'   => $this->tempat_lahir,
            'tanggal_lahir'  => (string) $this->tanggal_lahir,
            'jenis_kelamin'  => $this->jenis_kelamin,
            'alamat'         => $this->alamat,
            'telepon'        => $this->telepon,
            'jabatan_id'     => $this->jabatan_id,
            'jabatan'        => Resource::make($this->whenLoaded('jabatan')),
            'path'           => $this->path,
            '__editable'     => $request->user()->can('update', $this->resource),
            '__deletable'    => $request->user()->can('delete', $this->resource),
        ];
    }
}
