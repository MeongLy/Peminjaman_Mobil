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
        'kalapas_token',
        'kalapas_approved_at',
        'kalapas_note',
    ];

    protected $casts = [
        'tanggal'             => 'date',
        'kalapas_approved_at' => 'datetime',
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
