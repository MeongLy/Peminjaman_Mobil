<?php

namespace Database\Seeders;

use App\Models\Mobil;
use App\Models\Pemakaian;
use App\Models\User;
use Illuminate\Database\Seeder;

class PemakaianSeeder extends Seeder
{
    public function run(): void
    {
        $user  = User::where('email', 'user@lapas.id')->first();
        $mobil = Mobil::where('plat', 'KH 1949 AU')->first();

        if (!$user || !$mobil) return;

        Pemakaian::create([
            'mobil_id'    => $mobil->id,
            'user_id'     => $user->id,
            'pengguna'    => 'Ibu Siti Aminah',
            'bidang'      => 'Bidang Pembinaan',
            'tujuan'      => 'Kunjungan dinas ke Dinas Sosial',
            'tanggal'     => now()->toDateString(),
            'jam_keluar'  => '08:00',
            'jam_kembali' => '16:00',
            'status'      => 'Disetujui',
            'keterangan'  => null,
        ]);
    }
}
