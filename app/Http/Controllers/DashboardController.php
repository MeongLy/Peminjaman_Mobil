<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data mobil dari MobilController (single source of truth)
        $semuaMobil = (new MobilController())->getAllMobil();

        // Hitung statistik dari data real
        $stats = [
            'totalMobil'     => count($semuaMobil),
            'mobilTersedia'  => collect($semuaMobil)->where('status', 'Tersedia')->count(),
            'mobilDigunakan' => collect($semuaMobil)->where('status', 'Digunakan')->count(),
            'totalPemakaian' => 25, // total pemakaian bulan ini (dummy)
        ];

        // Ambil 5 mobil terbaru (4 dari data real)
        $mobilTerbaru = collect($semuaMobil)->take(5)->values()->all();

        return view('dashboard', compact('stats', 'mobilTerbaru'));
    }
}
