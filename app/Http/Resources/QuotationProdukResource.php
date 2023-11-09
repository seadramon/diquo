<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuotationProdukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "sbu" => $this->sbu,
            "kd_produk" => $this->kd_produk,
            "tipe_produk" => $this->tipe_produk,
            "harsat_produk" => $this->harsat_produk,
            "volume" => $this->volume,
            "total" => $this->total,
            "transportasi" => $this->transportasi,
        ];
    }
}
