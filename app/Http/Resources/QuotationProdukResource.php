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
        $tipe = explode(' - ', $this->tipe_produk);
        return [
            "sbu" => $this->sbu,
            "kd_produk" => $this->kd_produk,
            "tipe_produk" => count($tipe) < 2 ? $this->tipe_produk : $tipe[1],
            "harsat_produk" => $this->harsat_produk,
            "volume" => $this->volume,
            "total" => $this->total,
            "transportasi" => $this->transportasi,
            "indeks" => $this->quotation->idx_hpju,
            "hju" => $this->hju,
            "total_hju" => $this->total_hju,
        ];
    }
}
