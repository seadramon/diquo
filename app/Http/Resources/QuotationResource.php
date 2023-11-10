<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuotationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "sbu" => !empty($this->getsbu)?$this->getsbu->singkatan2.' - '.$this->getsbu->nama_sbu:'-',
            "no_surat" => $this->no_surat,
            "nama_pelanggan" => $this->nama_pelanggan,
            "nama_proyek" => $this->nama_proyek,
            "lokasi_proyek" => $this->lokasi_proyek,
            "status" => $this->status,
            "pic" => !empty($this->getpic)?$this->getpic->full_name:'-',
            "created_at" => date('d/m/Y', strtotime($this->created_at)),
        ];
    }
}
