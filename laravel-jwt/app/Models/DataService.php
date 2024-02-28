<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataService extends Model
{
    use HasFactory;

    protected $fillable = [
        'kerusakan',
        'deskripsi',
        'tanggal_service',
        'selesai_service',
        'teknisi',
        'biaya',
        'id_barang',
    ];
}