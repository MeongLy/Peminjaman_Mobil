<?php

namespace Database\Seeders;

use App\Models\Mobil;
use Illuminate\Database\Seeder;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama'        => 'Avanza Veloz',
                'plat'        => 'KH 1587 FBF',
                'merk'        => 'Toyota',
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
                'nama'        => 'Livina',
                'plat'        => 'KH 1949 AU',
                'merk'        => 'Nissan',
                'tipe'        => 'Nissan Livina',
                'tahun'       => 2023,
                'kursi'       => 5,
                'transmisi'   => 'Otomatis',
                'warna'       => 'Merah',
                'bahan_bakar' => 'Bensin',
                'status'      => 'Digunakan',
                'pemegang'    => 'Ibu Siti Aminah',
                'kondisi'     => 'Baik',
                'foto'        => 'Livina.jpeg',
            ],
            [
                'nama'        => 'Ambulance',
                'plat'        => 'KH 1739 PHX',
                'merk'        => 'Daihatsu',
                'tipe'        => 'Ambulance',
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
                'nama'        => 'Transpas',
                'plat'        => 'KH 7020 PPB',
                'merk'        => 'Daihatsu',
                'tipe'        => 'Transpas',
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

        foreach ($data as $item) {
            Mobil::updateOrCreate(['plat' => $item['plat']], $item);
        }
    }
}
