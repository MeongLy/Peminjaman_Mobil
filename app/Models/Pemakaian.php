<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    protected $fillable = [
        'mobil_id',
        'user_id',
        'pengguna',
        'bidang',
        'tujuan',
        'tanggal',
        'jam_keluar',
        'jam_kembali',
        'status',
        'keterangan',
    ];

    // Tambahkan ini
    protected $casts = [
        'tanggal' => 'date',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
