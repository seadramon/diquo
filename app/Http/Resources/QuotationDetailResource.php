<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuotationDetailResource extends JsonResource
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
            "id" => $this->id,
            "no_surat" => $this->no_surat,
            "nama_pelanggan" => $this->nama_pelanggan,
            "nama_perusahaan" => $this->nama_perusahaan,
            "no_hp" => $this->no_hp,
            "email" => $this->email,
            "nama_proyek" => $this->nama_proyek,
            "lokasi_proyek" => $this->lokasi_proyek,
            "kondisi_pengiriman" => $this->kondisi_pengiriman,
            "pic" => [
                "employee_id" => $this->pic,
                "nama" => $this->getpic ? $this->getpic->full_name : "not found"
            ],
            "sbu" => [
                "kd_sbu" => $this->sbu,
                "nama" => $this->getsbu ? $this->getsbu->singkatan2 . ' - ' . $this->getsbu->nama_sbu : "not found"
            ],
            "kd_material" => $this->kd_material,
            "ket_material" => $this->ket_material,
            "pabrik" => [
                "kd_pabrik" => $this->kd_pabrik,
                "nama" => $this->pabrik->ket ?? "",
            ],
            "jarak" => $this->jarak,
            "harga_angkutan" => $this->harga_angkutan,
            "idx_cad_hpp" => $this->idx_cad_hpp,
            "idx_cad_transportasi" => $this->idx_cad_transportasi,
            "idx_hpju" => $this->idx_hpju,
            "biaya_pelaksanaan" => $this->biaya_pelaksanaan,
            "products" => QuotationProdukResource::collection($this->produk),
        ];
    }
}
