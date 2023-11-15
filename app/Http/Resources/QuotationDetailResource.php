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
        $produk = $this->produk;
        $total_harga_jual = $produk->map(function($item){ return $item->total_hju; })->sum();
        $total_hpp = $produk->map(function($item){ return $item->harsat_produk * $item->panjang * $item->volume; })->sum();
        $total_transportasi = $produk->map(function($item){ return $item->transportasi * $item->panjang * $item->volume; })->sum();
        $total_bup = $total_harga_jual * $this->biaya_pelaksanaan / 100;
        $total_lkb = $total_harga_jual - $total_hpp - $total_transportasi - $total_bup;
        $persen_lkb = $total_harga_jual > 0 ? round($total_lkb / $total_harga_jual * 100, 2) : 0;
        $total_index = $persen_lkb + $this->biaya_pelaksanaan;

        return [
            "id" => $this->id,
            "no_surat" => $this->no_surat,
            "nama_pelanggan" => $this->nama_pelanggan,
            "nama_perusahaan" => $this->nama_perusahaan,
            "no_hp" => $this->no_hp,
            "email" => $this->email,
            "nama_proyek" => $this->nama_proyek,
            "lokasi_proyek" => $this->lokasi_proyek,
            "kondisi_pengiriman" => strtoupper($this->kondisi_pengiriman),
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
            "total_harga_jual" => $total_harga_jual,
            "total_hpp" => $total_hpp,
            "total_transportasi" => $total_transportasi,
            "total_bup" => $total_bup,
            "total_lkb" => $total_lkb,
            "persen_lkb" => $persen_lkb,
            "total_index" => $total_index,
            "products" => QuotationProdukResource::collection($produk),
        ];
    }
}
