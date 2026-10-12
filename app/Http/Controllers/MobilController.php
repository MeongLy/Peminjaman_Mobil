<?php

namespace App\Http\Controllers;

class MobilController extends Controller
{
    private array $mobil = [
        [
            'id'       => 1,
            'nama'     => 'Toyota Avanza',
            'plat'     => 'KH 1234 XY',
            'merk'     => 'Toyota',
            'tipe'     => 'Avanza 1.3 G',
            'tahun'    => 2022,
            'kursi'    => 7,
            'transmisi'=> 'Manual',
            'warna'    => 'Putih',
            'bahan_bakar' => 'Bensin',
            'status'   => 'Tersedia',
            'pemegang' => null,           // siapa yang sedang pakai
            'kondisi'  => 'Baik',
        ],
        [
            'id'       => 2,
            'nama'     => 'Honda Brio',
            'plat'     => 'KH 5678 AB',
            'merk'     => 'Honda',
            'tipe'     => 'Brio Satya E',
            'tahun'    => 2023,
            'kursi'    => 5,
            'transmisi'=> 'Otomatis',
            'warna'    => 'Merah',
            'bahan_bakar' => 'Bensin',
            'status'   => 'Digunakan',
            'pemegang' => 'Ibu Siti Aminah',
            'kondisi'  => 'Baik',
        ],
        [
            'id'       => 3,
            'nama'     => 'Daihatsu Xenia',
            'plat'     => 'KH 9012 CD',
            'merk'     => 'Daihatsu',
            'tipe'     => 'Xenia 1.3 R',
            'tahun'    => 2021,
            'kursi'    => 7,
            'transmisi'=> 'Manual',
            'warna'    => 'Silver',
            'bahan_bakar' => 'Bensin',
            'status'   => 'Tersedia',
            'pemegang' => null,
            'kondisi'  => 'Baik',
        ],
        [
            'id'       => 4,
            'nama'     => 'Toyota Innova',
            'plat'     => 'KH 3456 EF',
            'merk'     => 'Toyota',
            'tipe'     => 'Innova Reborn V',
            'tahun'    => 2023,
            'kursi'    => 7,
            'transmisi'=> 'Otomatis',
            'warna'    => 'Hitam',
            'bahan_bakar' => 'Diesel',
            'status'   => 'Tersedia',
            'pemegang' => null,
            'kondisi'  => 'Baik',
        ],
        [
            'id'       => 5,
            'nama'     => 'Mitsubishi Xpander',
            'plat'     => 'KH 7890 GH',
            'merk'     => 'Mitsubishi',
            'tipe'     => 'Xpander Ultimate',
            'tahun'    => 2022,
            'kursi'    => 7,
            'transmisi'=> 'Manual',
            'warna'    => 'Abu-abu',
            'bahan_bakar' => 'Bensin',
            'status'   => 'Digunakan',
            'pemegang' => 'Ibu Budi Santoso',
            'kondisi'  => 'Baik',
        ],
        [
            'id'       => 6,
            'nama'     => 'Honda Mobilio',
            'plat'     => 'KH 2345 IJ',
            'merk'     => 'Honda',
            'tipe'     => 'Mobilio E',
            'tahun'    => 2021,
            'kursi'    => 7,
            'transmisi'=> 'Manual',
            'warna'    => 'Putih',
            'bahan_bakar' => 'Bensin',
            'status'   => 'Tersedia',
            'pemegang' => null,
            'kondisi'  => 'Baik',
        ],
    ];

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
