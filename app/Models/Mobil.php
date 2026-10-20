<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $fillable = [
        'nama', 'plat', 'merk', 'tipe', 'tahun', 'kursi',
        'transmisi', 'warna', 'bahan_bakar', 'status', 'kondisi', 'foto',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'kursi' => 'integer',
    ];
}
