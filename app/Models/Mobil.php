<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mobil extends Model
{
    protected $fillable = [
        'nama',
        'plat',
        'merk',
        'tipe',
        'tahun',
        'kursi',
        'transmisi',
        'warna',
        'bahan_bakar',
        'status',
        'pemegang',
        'kondisi',
        'foto',
    ];

    protected $casts = [
        'tahun'  => 'integer',
        'kursi'  => 'integer',
    ];

    public function pemakaian(): HasMany
    {
        return $this->hasMany(Pemakaian::class, 'mobil_id');
    }

    public function scopeTersedia($query)
    {
        return $query->where('status', 'Tersedia');
    }
}
