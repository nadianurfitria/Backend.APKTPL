<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataRiwayatResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'kelas' => $this->kelas,
            'jenis_barang' => $this->jenis_barang,
            'merk' => $this->merk,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'datapeminjaman' => DataPeminjamanResource::collection($this->whenLoaded('datapeminjaman')), // Memuat data peminjaman jika sudah dimuat
        ];
    }
}
