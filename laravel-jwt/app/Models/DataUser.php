<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'nisn',
        'email',
        'email_verified_at',
        'password',
        'id_kelas',
        'status',
    ];
}