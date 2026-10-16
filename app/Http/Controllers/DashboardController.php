<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pemakaian;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalMobil'     => Mobil::count(),
            'mobilTersedia'  => Mobil::where('status', 'Tersedia')->count(),
            'mobilDigunakan' => Mobil::where('status', 'Digunakan')->count(),
            'totalPemakaian' => Pemakaian::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->count(),
        ];

        $mobilTerbaru = Mobil::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'mobilTerbaru'));
    }
}
