<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataPeminjamanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_barang' => $this->id_barang,
            'id_user' => $this->id_user,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}