<?php

namespace App\Http\Controllers;

class MobilController extends Controller
{
    private array $mobil = [
        [
            'id'          => 1,
            'nama'        => 'Avanza Veloz',
            'plat'        => 'KH 1587 FBF',
            'merk'        => 'Avanza',
            'tipe'        => 'Avanza 1.3 G',
            'tahun'       => 2022,
            'kursi'       => 7,
            'transmisi'   => 'Manual',
            'warna'       => 'Hitam',
            'bahan_bakar' => 'Bensin',
            'status'      => 'Tersedia',
            'pemegang'    => null,
            'kondisi'     => 'Baik',
            'foto'        => 'Veloz.jpeg',
        ],
        [
            'id'          => 2,
            'nama'        => 'Livina',
            'plat'        => 'KH 1949 AU',
            'merk'        => 'Nissan',
            'tipe'        => 'Nissan',
            'tahun'       => 2023,
            'kursi'       => 5,
            'transmisi'   => 'Otomatis',
            'warna'       => 'Merah',
            'bahan_bakar' => 'Bensin',
            'status'      => 'Digunakan',
            'pemegang'    => 'Ibu Yuli',
            'kondisi'     => 'Baik',
            'foto'        => 'Livina.jpeg',
        ],
        [
            'id'          => 3,
            'nama'        => 'Ambulance',
            'plat'        => 'KH 1739 PHX',
            'merk'        => 'Daihatsu',
            'tipe'        => 'Daihatsu',
            'tahun'       => 2021,
            'kursi'       => 7,
            'transmisi'   => 'Manual',
            'warna'       => 'Silver',
            'bahan_bakar' => 'Bensin',
            'status'      => 'Tersedia',
            'pemegang'    => null,
            'kondisi'     => 'Baik',
            'foto'        => 'Ambulance.jpeg',
        ],
        [
            'id'          => 4,
            'nama'        => 'Transpas',
            'plat'        => 'KH 7020 PPB',
            'merk'        => 'Daihatsu',
            'tipe'        => 'Daihatsu',
            'tahun'       => 2023,
            'kursi'       => 7,
            'transmisi'   => 'Otomatis',
            'warna'       => 'Hitam',
            'bahan_bakar' => 'Diesel',
            'status'      => 'Tersedia',
            'pemegang'    => null,
            'kondisi'     => 'Baik',
            'foto'        => 'Transpas.jpeg',
        ],
    ];

    /**
     * Ambil semua data mobil (untuk dipakai controller lain).
     */
    public function getAllMobil(): array
    {
        return $this->mobil;
    }

    public function index()
    {
        $mobil = $this->mobil;
        return view('mobil.index', compact('mobil'));
    }

    public function show($id)
    {
        $mobil = collect($this->mobil)->firstWhere('id', (int) $id);
        abort_if(!$mobil, 404);

        return view('mobil.show', compact('mobil'));
    }
}
