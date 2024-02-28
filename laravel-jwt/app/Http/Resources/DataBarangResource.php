<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataBarangResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'jenis_barang' => $this->jenis_barang,
            'merk' => $this->merk,
            'id_ruang' => $this->id_ruang,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}