<?php

namespace App\Http\Resources\Layanan;

use App\Http\Resources\Master\Resource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kepegawaian\PegawaiResource;
use App\Http\Resources\Master\Penyakit\PenyakitResource;

class DiagnosaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $penyakit = PenyakitResource::make($this->whenLoaded('penyakit'));

        $tipe     = Resource::make($this->whenLoaded('tipe'));

        $petugas  = PegawaiResource::make($this->whenLoaded('petugas'));

        return [
            'id'               => $this->id,
            'kasus'            => $this->kasus,
            'lama_menderita'   => $this->lama_menderita,
            'penyakit_id'      => $this->penyakit_id,
            'penyakit'         => $penyakit,
            'petugas_id'       => $this->petugas_id,
            'petugas'          => $petugas,
            'tipe_diagnosa_id' => $this->tipe_diagnosa_id,
            'tipe'             => $tipe,
            'waktu'            => $this->waktu,
            'path'             => $this->path,
        ];
    }
}
