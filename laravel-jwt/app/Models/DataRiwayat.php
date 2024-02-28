<?php

namespace App\Models;

use App\Models\DataPeminjaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Model DataRiwayat.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRiwayat extends Model
{
    protected $fillable = ['nama', 'kelas', 'jenis_barang', 'merk', 'status'];

    // Definisikan relasi dengan data peminjaman
    public function datapeminjaman()
    {
        return $this->hasMany(DataPeminjaman::class);
    }
}
