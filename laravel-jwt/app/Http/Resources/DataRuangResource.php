<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataRuangResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_ruang' => $this->nama_ruang,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}