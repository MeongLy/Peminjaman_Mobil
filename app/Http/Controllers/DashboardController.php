<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalMobil'       => 12,
            'mobilTersedia'    => 8,
            'mobilDigunakan'   => 4,
            'totalPemakaian'   => 25,   // total pemakaian bulan ini
        ];

        $mobilTerbaru = [
            ['id' => 1, 'nama' => 'Toyota Avanza',     'plat' => 'KH 1234 XY', 'status' => 'Tersedia',  'warna' => 'Putih'],
            ['id' => 2, 'nama' => 'Honda Brio',        'plat' => 'KH 5678 AB', 'status' => 'Digunakan', 'warna' => 'Merah'],
            ['id' => 3, 'nama' => 'Daihatsu Xenia',    'plat' => 'KH 9012 CD', 'status' => 'Tersedia',  'warna' => 'Silver'],
            ['id' => 4, 'nama' => 'Toyota Innova',     'plat' => 'KH 3456 EF', 'status' => 'Tersedia',  'warna' => 'Hitam'],
            ['id' => 5, 'nama' => 'Mitsubishi Xpander','plat' => 'KH 7890 GH', 'status' => 'Digunakan', 'warna' => 'Abu-abu'],
        ];

        return view('dashboard', compact('stats', 'mobilTerbaru'));
    }
}
