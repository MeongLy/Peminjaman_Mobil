<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemakaian extends Model
{
    protected $table = 'pemakaian';

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

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function mobil(): BelongsTo
    {
        return $this->belongsTo(Mobil::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
