<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataServiceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'kerusakan' => $this->kerusakan,
            'deskripsi' => $this->deskripsi,
            'tanggal_servis' => $this->tanggal_servis,
            'selesai_servis' => $this->selesai_servis,
            'teknisi' => $this->teknisi,
            'biaya' => $this->biaya,
            'id_barang' => $this->id_barang,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}