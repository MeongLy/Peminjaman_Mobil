<?php

namespace App\Http\Controllers;

class PeminjamanController extends Controller
{
    private array $pemakaian = [
        [
            'id'          => 1,
            'mobil'       => 'Honda Brio',
            'plat'        => 'KH 5678 AB',
            'pengguna'    => 'Ibu Siti Aminah',
            'bidang'      => 'Bidang Pembinaan',
            'tujuan'      => 'Kunjungan dinas ke Dinas Sosial',
            'tanggal'     => '2025-10-10',
            'jam_keluar'  => '08:00',
            'jam_kembali' => '16:00',
            'status'      => 'Digunakan',
        ],
        [
            'id'          => 2,
            'mobil'       => 'Mitsubishi Xpander',
            'plat'        => 'KH 7890 GH',
            'pengguna'    => 'Ibu Budi Santoso',
            'bidang'      => 'Bidang Administrasi',
            'tujuan'      => 'Antar dokumen ke Kanwil',
            'tanggal'     => '2025-10-08',
            'jam_keluar'  => '09:30',
            'jam_kembali' => '13:00',
            'status'      => 'Digunakan',
        ],
        [
            'id'          => 3,
            'mobil'       => 'Toyota Avanza',
            'plat'        => 'KH 1234 XY',
            'pengguna'    => 'Ibu Ahmad Yani',
            'bidang'      => 'Bidang Umum',
            'tujuan'      => 'Rapat koordinasi di Pemprov',
            'tanggal'     => '2025-09-25',
            'jam_keluar'  => '07:30',
            'jam_kembali' => '15:00',
            'status'      => 'Selesai',
        ],
        [
            'id'          => 4,
            'mobil'       => 'Daihatsu Xenia',
            'plat'        => 'KH 9012 CD',
            'pengguna'    => 'Ibu Dedi Kurniawan',
            'bidang'      => 'Bidang KPLP',
            'tujuan'      => 'Pengantaran tamu ke bandara',
            'tanggal'     => '2025-09-20',
            'jam_keluar'  => '10:00',
            'jam_kembali' => '12:30',
            'status'      => 'Selesai',
        ],
    ];

    public function index()
    {
        $peminjaman = $this->pemakaian;
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function show($id)
    {
        $peminjaman = collect($this->pemakaian)->firstWhere('id', (int) $id);
        abort_if(!$peminjaman, 404);

        return view('peminjaman.show', compact('peminjaman'));
    }
}
